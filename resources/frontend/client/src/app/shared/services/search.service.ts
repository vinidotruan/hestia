import { Injectable } from "@angular/core";
import { HttpClient } from "@angular/common/http";
import { environment } from "@env/environment";

@Injectable({
  providedIn: "root"
})
export class SearchService {

  private baseRoute = `${environment.apiUrl}`;

  constructor(private httpClient: HttpClient) {
  }

  search(data) {
    return this.httpClient.get(`${this.baseRoute}/ongs?distance=${data.distance}&lat=${data.lat}&lon=${data.lon}`);
  }
}
