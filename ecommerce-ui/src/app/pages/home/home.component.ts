import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/core/auth.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent {
  constructor(private auth: AuthService, private router: Router) {}

  logout() {
    this.auth.logout().subscribe(() => {
      localStorage.removeItem('token');
      this.router.navigate(['/login']);
    });
  }
}
