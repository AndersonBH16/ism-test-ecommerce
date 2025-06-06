import { Component, HostBinding, OnInit, OnDestroy } from '@angular/core';

@Component({
  selector: 'app-sidebar',
  templateUrl: './sidebar.component.html',
  styleUrls: ['./sidebar.component.css']
})
export class SidebarComponent implements OnInit, OnDestroy {
  @HostBinding('class.expanded') isExpanded = false;
  private resizeListener?: () => void;

  ngOnInit() {
    this.checkScreenSize();
    this.resizeListener = () => this.checkScreenSize();
    window.addEventListener('resize', this.resizeListener);
  }

  ngOnDestroy() {
    if (this.resizeListener) {
      window.removeEventListener('resize', this.resizeListener);
    }
  }

  private checkScreenSize() {
    if (window.innerWidth < 480) {
      this.isExpanded = false;
    } else {
      this.isExpanded = true;
    }
  }

  toggleSidebar() {
    if (window.innerWidth < 480) {
      this.isExpanded = !this.isExpanded;
    }
  }
  
  collapseSidebarOnMobile() {
    if (window.innerWidth < 480) {
      this.isExpanded = false;
    }
  }
}
