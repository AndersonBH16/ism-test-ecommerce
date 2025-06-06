import { Component, OnInit, ViewChild, HostListener, ElementRef } from '@angular/core';
import { MatSidenav } from '@angular/material/sidenav';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  @ViewChild('sidenav') sidenav!: MatSidenav;
  @ViewChild('sidebar') sidebar!: ElementRef;

  isMobile = false;
  isTablet = false;

  constructor() { }

  ngOnInit(): void {
    this.checkScreenSize();
  }

  @HostListener('window:resize', ['$event'])
  onResize(event: any) {
    this.checkScreenSize();
  }

  private checkScreenSize() {
    const width = window.innerWidth;
    this.isMobile = width <= 480;
    this.isTablet = width <= 768 && width > 480;

    if (this.sidenav) {
      if (this.isMobile) {
        this.sidenav.mode = 'over';
        this.sidenav.close();
      } else if (this.isTablet) {
        this.sidenav.mode = 'over';
      } else {
        this.sidenav.mode = 'side';
        this.sidenav.open();
      }
    }
  }

  toggleSidenav() {
    if (this.isMobile) {
      // En móvil, alternar la clase expanded en lugar de abrir/cerrar
      const sidebarElement = document.querySelector('app-sidebar');
      if (sidebarElement) {
        sidebarElement.classList.toggle('expanded');
      }
    } else {
      // En tablet y desktop, comportamiento normal
      this.sidenav.toggle();
    }
  }
}
