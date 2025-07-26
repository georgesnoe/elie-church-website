import { Component } from '@angular/core';

@Component({
  selector: 'church-footer',
  imports: [],
  templateUrl: './church-footer.html',
  styleUrl: './church-footer.css',
})
export class ChurchFooter {
  currentYear: number = new Date().getFullYear();
}
