import { Injectable } from '@angular/core';
import { Http } from '@angular/http';
import 'rxjs/add/operator/map';

/*
  Generated class for the BirdsService provider.

  See https://angular.io/docs/ts/latest/guide/dependency-injection.html
  for more info on providers and Angular 2 DI.
*/
@Injectable()
export class BirdsService {

  constructor(public http: Http) {
    console.log('Hello BirdsService Provider');
  }

  getAll()
  {
    return new Promise(
      resolve=>{
          this.http.get('http://pajaros.com/all')
          .map(res=>res.json()) //Mapeando el resultado y devolviendolo como un JSON
          .subscribe( //Suscribiendose y devolviendo los resultados amiento
            data => {
              //this.avistamiento = data;
              resolve(data);
            },
            err => { //Añaniendo un handle para el error
                console.log(err);
            }
          )
      }
    );
  }

  addVez(id)
  {
    return new Promise(
      resolve=>{
          this.http.get('http://pajaros.com/one'+id)
          .map(res=>res.json()) //Mapeando el resultado y devolviendolo como un JSON
          .subscribe( //Datos a disposición para quien se suscriba 
            data => {
              //this.avistamiento = data;
              resolve(data); //Devuelve los datos en el momento en que esten disponibles
            },
            err => { //Añaniendo un handle para el error
                console.log(err);
            }
          )
      }
    );
  }

  add(data)
  {
    return new Promise(
      resolve=>{
          this.http.post('http://pajaros.com/add', data)
          .map(res=>res.json()) //Mapeando el resultado y devolviendolo como un JSON
          .subscribe( //Datos a disposición para quien se suscriba 
            data => {
              //this.avistamiento = data;
              resolve(data); //Devuelve los datos en el momento en que esten disponibles
            },
            err => { //Añaniendo un handle para el error
                console.log(err);
            }
          )
      }
    );
  }

  addVeces(data)
  {
    return new Promise(
      resolve=>{
          this.http.put('http://pajaros.com/updateVez', data)
          .map(res=>res.json()) //Mapeando el resultado y devolviendolo como un JSON
          .subscribe( //Datos a disposición para quien se suscriba 
            data => {
              //this.avistamiento = data;
              resolve(data); //Devuelve los datos en el momento en que esten disponibles
            },
            err => { //Añaniendo un handle para el error
                console.log(err);
            }
          )
      }
    );
  }

  update(data)
  {
    return new Promise(
      resolve=>{
          this.http.put('http://pajaros.com/update', data)
          .map(res=>res.json()) //Mapeando el resultado y devolviendolo como un JSON
          .subscribe( //Datos a disposición para quien se suscriba 
            data => {
              //this.avistamiento = data;
              resolve(data); //Devuelve los datos en el momento en que esten disponibles
            },
            err => { //Añaniendo un handle para el error
                console.log(err);
            }
          )
      }
    );
  }

  delete(id)
  {
    return new Promise(
      resolve=>{
          this.http.delete('http://pajaros.com/delete'+id)
          .map(res=>res.json()) //Mapeando el resultado y devolviendolo como un JSON
          .subscribe( //Datos a disposición para quien se suscriba 
            data => {
              //this.avistamiento = data;
              resolve(data); //Devuelve los datos en el momento en que esten disponibles
            },
            err => { //Añaniendo un handle para el error
                console.log(err);
            }
          )
      }
    );
  }

}
