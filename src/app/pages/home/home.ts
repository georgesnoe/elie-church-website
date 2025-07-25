import { Component } from '@angular/core';
import { LucideAngularModule, Menu, X } from 'lucide-angular';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-home',
  imports: [LucideAngularModule, CommonModule],
  templateUrl: './home.html',
  styleUrl: './home.css',
})
export class Home {
  currentYear: number = new Date().getFullYear();
  isMenuOpen = false;
  readonly Menu = Menu;
  readonly X = X;
  toggleMenu() {
    this.isMenuOpen = !this.isMenuOpen;
  }
}
