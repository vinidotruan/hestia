import { Injectable } from "@angular/core";
import { HttpClient } from "@angular/common/http";
import { map, Observable } from "rxjs";
import { environment } from "@env/environment";

@Injectable({
  providedIn: "root"
})
export class AuthService {

  private baseRoute = `${environment.apiUrl}`;

  constructor(private httpClient: HttpClient) {
  }

  login(data: any): Observable<any> {
    return this.httpClient.post(`${this.baseRoute}/auth/login`, data)
      .pipe(map((response: LoginRequestResponse) => {
        localStorage.setItem("token", response.token);
      }));
  }

  logout(): Observable<any> {
    return this.httpClient.post(`${this.baseRoute}/auth/logout`, {});
  }

  authToken(): string {
    return localStorage.getItem("token");
  }
}

export class LoginRequestResponse {
  token: string;
}
