import type { User } from "./User";

export interface Vehicle {
  id: number;
  brand: string;
  model: string;
  license_plate: string;
  hourly_rate: number;
  provider: User
}