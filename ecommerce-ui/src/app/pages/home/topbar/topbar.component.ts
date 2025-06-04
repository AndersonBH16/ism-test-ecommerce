import {Component, EventEmitter, Output} from '@angular/core';
import {AuthService} from "../../../core/auth.service";
import {Router} from "@angular/router";

@Component({
  selector: 'app-topbar',
  templateUrl: './topbar.component.html',
  styleUrls: ['./topbar.component.css']
})
export class TopbarComponent {
  constructor(private auth: AuthService, private router: Router) {}

  @Output() toggleSidenav = new EventEmitter<void>();
  logout() {
    this.auth.logout().subscribe(() => {
      localStorage.removeItem('token');
      this.router.navigate(['/login']);
    });
  }
}
