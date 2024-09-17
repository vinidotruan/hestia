import { Component } from "@angular/core";
import { IbgeService, UF } from "@shared/services/ibge/ibge.service";
import { NgForOf } from "@angular/common";

@Component({
  selector: "app-settings",
  standalone: true,
  imports: [
    NgForOf
  ],
  templateUrl: "./settings.component.html",
  styleUrl: "./settings.component.scss"
})
export class SettingsComponent {
  ufs: UF[];

  constructor(private ibgeService: IbgeService) {
    ibgeService.getUFs().subscribe({
      next: response => this.ufs = response
    });
  }
}
