import { Routes } from "@angular/router";

export const routes: Routes = [
  {
    path: "",
    loadComponent: () => import("./pages/auth/auth.component").then(m => m.AuthComponent)
  },
  {
    path: "home",
    loadComponent: () => import("./pages/home/home.component").then(m => m.HomeComponent)
  }
];
