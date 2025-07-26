import { Component } from '@angular/core';
import { LucideAngularModule, Menu, X } from 'lucide-angular';
import { CommonModule } from '@angular/common';
import { ChurchHeader } from '../../components/church-header/church-header';

@Component({
  selector: 'app-home',
  imports: [LucideAngularModule, CommonModule, ChurchHeader],
  templateUrl: './home.html',
  styleUrl: './home.css',
})
export class Home {
  currentYear: number = new Date().getFullYear();
  readonly Menu = Menu;
  readonly X = X;
}
