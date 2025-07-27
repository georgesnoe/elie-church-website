import { Routes } from '@angular/router';

export const routes: Routes = [
  {
    path: '',
    loadComponent: () => import('./pages/home/home').then((m) => m.Home),
    title: 'Acceuil - Eglise méthodiste du Togo',
  },
  {
    path: 'history',
    loadComponent: () =>
      import('./pages/history/history').then((m) => m.History),
    title: "Histoire de l'église - Eglise méthodiste du Togo",
  },
];
