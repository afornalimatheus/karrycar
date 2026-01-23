import { createRouter, createWebHistory, type RouteRecordRaw } from 'vue-router';
import { authService } from '@/services/authService';

import Login from '@/views/Login.vue';
import Main from '@/layouts/Main.vue';
import ProviderDashboard from '@/views/Dashboard.vue';

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    redirect: () => {
      const user = authService.getUser();

      if (!user) {
        return '/login'
      }

      return user.role === 'provider' 
        ? `/provider/${user.id}/dashboard` 
        : `/consumer/${user.id}/dashboard`;
    }
  },
  {
    path: '/login',
    name: 'Login',
    component: Login,
    meta: { requiresGuest: true }
  },
  {
    path: '/provider/:providerId',
    component: Main,
    meta: { 
      requiresAuth: true, 
      role: 'provider',
    },
    children: [
      {
        path: 'dashboard',
        name: 'ProviderDashboard',
        component: ProviderDashboard
      },
      {
        path: 'vehicles',
        name: 'ProviderVehicles',
        component: () => import('@/views/provider/Vehicles.vue')
      }
    ]
  },
  {
    path: '/consumer/:consumerId',
    component: Main,
    meta: { 
      requiresAuth: true, 
      role: 'consumer' 
    },
    children: [
      {
        path: 'dashboard',
        name: 'ConsumerDashboard',
        component: ProviderDashboard
      },
      {
        path: 'vehicles',
        name: 'ConsumerAvailableVehicles',
        component: () => import('@/views/consumer/AvailableVehicles.vue')
      }
    ]
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

router.beforeEach((to, from, next) => {
  const isAuthenticated = authService.isAuthenticated();
  const user = authService.getUser();

  if (to.meta.requiresAuth && !isAuthenticated) {
    return next('/login');
  }

  if (to.meta.requiresGuest && isAuthenticated) {
    return next('/');
  }

  if (to.meta.role && user?.role !== to.meta.role) {
    return next('/');
  }

  const routeUserId = to.params.providerId || to.params.consumerId;
  if (routeUserId && user && String(routeUserId) !== String(user.id)) {
    return next('/');
  }

  next();
});

export default router;
