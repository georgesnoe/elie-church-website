import { Component } from '@angular/core';
import { LucideAngularModule, Menu, X } from 'lucide-angular';
import { CommonModule } from '@angular/common';
import { ChurchHeader } from '../../components/church-header/church-header';
import { ChurchFooter } from '../../components/church-footer/church-footer';

@Component({
  selector: 'app-home',
  imports: [LucideAngularModule, CommonModule, ChurchHeader, ChurchFooter],
  templateUrl: './home.html',
  styleUrl: './home.css',
})
export class Home {
  readonly Menu = Menu;
  readonly X = X;
}
