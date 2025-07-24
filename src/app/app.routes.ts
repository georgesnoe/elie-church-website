import { Routes } from '@angular/router';

export const routes: Routes = [
  {
    path: '',
    loadComponent: () => import('./app').then((m) => m.App),
    title: 'Acceuil - Eglise méthodiste du Togo',
  },
];
