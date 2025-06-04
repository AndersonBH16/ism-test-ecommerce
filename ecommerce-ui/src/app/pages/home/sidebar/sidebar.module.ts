import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { SidebarRoutingModule } from './sidebar-routing.module';
import { SidebarComponent } from './sidebar.component';
import {MatListModule} from "@angular/material/list";
import {MatSidenavModule} from "@angular/material/sidenav";
import {TopbarModule} from "../topbar/topbar.module";
import {MatIconModule} from "@angular/material/icon";


@NgModule({
  declarations: [
    SidebarComponent
  ],
  exports: [
    SidebarComponent
  ],
  imports: [
    CommonModule,
    SidebarRoutingModule,
    MatListModule,
    MatSidenavModule,
    TopbarModule,
    MatIconModule
  ]
})
export class SidebarModule { }
