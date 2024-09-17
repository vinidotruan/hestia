import { Injectable } from "@angular/core";
import { HttpClient } from "@angular/common/http";

@Injectable({
  providedIn: "root"
})
export class IbgeService {

  private urlBase = "https://servicodados.ibge.gov.br/api/v1/localidades";

  constructor(private http: HttpClient) {
  }

  getUFs() {
    return this.http.get<UF[]>(`${this.urlBase}/estados?orderBy=nome`);
  }
}

export class UF {
  constructor(
    public id: string,
    public nome: string,
    public sigla: string,
    public regioes: any) {
  }
}
