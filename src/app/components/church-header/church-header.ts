import { Component, HostListener } from '@angular/core';
import { LucideAngularModule, Menu, X } from 'lucide-angular';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'church-header',
  imports: [LucideAngularModule, CommonModule],
  templateUrl: './church-header.html',
  styleUrl: './church-header.css',
})
export class ChurchHeader {
  isMenuOpen = false;
  isScrolled = false;
  readonly Menu = Menu;
  readonly X = X;

  @HostListener('window:scroll', [])
  onWindowScroll() {
    this.isScrolled = window.scrollY > 10;
  }

  toggleMenu() {
    this.isMenuOpen = !this.isMenuOpen;
  }

  navLinks = [
    { name: 'Accueil', href: '#' },
    { name: 'À Propos', href: '#' },
    { name: 'Sermons', href: '#' },
    { name: 'Événements', href: '#' },
    { name: 'Contact', href: '#' },
  ];
}
