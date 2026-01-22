import { ref, computed } from 'vue';
import { authService, type LoginCredentials } from '@/services/authService';

const user = ref(authService.getUser());
const loading = ref(false);
const error = ref<string | null>(null);

export function useAuth() {
  const isAuthenticated = computed(() => authService.isAuthenticated());
  const isProvider = computed(() => user.value?.role === 'provider');
  const isConsumer = computed(() => user.value?.role === 'consumer');

  const login = async (credentials: LoginCredentials) => {
    loading.value = true;
    error.value = null;

    try {
      const response = await authService.login(credentials);
      
      user.value = response.user;

      return response;
    } catch (err: any) {
      error.value = err.response?.data?.message || 'Erro ao fazer login';
      throw err;
    } finally {
      loading.value = false;
    }
  };

  const logout = () => {
    authService.logout();
    user.value = null;
  };

  return {
    user,
    loading,
    error,
    isAuthenticated,
    isProvider,
    isConsumer,
    login,
    logout,
  };
}
