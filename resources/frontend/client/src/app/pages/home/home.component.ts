import { Component } from "@angular/core";
import { FormControl, FormGroup, ReactiveFormsModule, Validators } from "@angular/forms";
import { SearchService } from "@shared/services/search.service";
import { JsonPipe, NgForOf } from "@angular/common";

@Component({
  selector: "app-home",
  standalone: true,
  imports: [
    ReactiveFormsModule,
    NgForOf,
    JsonPipe
  ],
  templateUrl: "./home.component.html",
  styleUrl: "./home.component.scss"
})
export class HomeComponent {
  form = new FormGroup({
    query: new FormControl(null),
    distance: new FormControl(0),
    lat: new FormControl("", [Validators.required]),
    lon: new FormControl("", [Validators.required])
  });
  ongs: any;

  constructor(private service: SearchService) {
    navigator.geolocation.getCurrentPosition(({ coords }) => {
      const latitude = coords.latitude.toString();
      const longitude = coords.longitude.toString();
      this.form.patchValue({ lat: latitude, lon: longitude });
    });
  }

  search() {
    this.service.search(this.form.value).subscribe({
      next: (response: any) => this.ongs = response.data,
      error: error => console.log(error)
    });
  }
}
