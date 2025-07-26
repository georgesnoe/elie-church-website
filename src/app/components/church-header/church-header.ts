import { Component } from '@angular/core';
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
  readonly Menu = Menu;
  readonly X = X;
  toggleMenu() {
    this.isMenuOpen = !this.isMenuOpen;
  }
}
