import { Component } from '@angular/core';
import {
  Facebook,
  Twitter,
  Youtube,
  Mail,
  Phone,
  MapPin,
} from 'lucide-angular';
import { LucideAngularModule } from 'lucide-angular';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'church-footer',
  imports: [LucideAngularModule, CommonModule],
  templateUrl: './church-footer.html',
})
export class ChurchFooter {
  currentYear: number = new Date().getFullYear();
  readonly Facebook = Facebook;
  readonly Twitter = Twitter;
  readonly Youtube = Youtube;
  readonly Mail = Mail;
  readonly Phone = Phone;
  readonly MapPin = MapPin;

  socials = [
    {
      name: 'Facebook',
      href: '#',
      icon: Facebook,
    },
    {
      name: 'Twitter',
      href: '#',
      icon: Twitter,
    },
    {
      name: 'YouTube',
      href: '#',
      icon: Youtube,
    },
  ];
}
