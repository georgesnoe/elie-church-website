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
  {
    path: 'activity',
    loadComponent: () =>
      import('./pages/activity/activity').then((m) => m.Activity),
    title: "Activités de l'église - Eglise méthodiste du Togo",
  },
  {
    path: 'teachings',
    loadComponent: () =>
      import('./pages/teachings/teachings').then((m) => m.Teachings),
    title: "Enseignements de l'église - Eglise méthodiste du Togo",
  },
];
