#include<stdio.h>
#include<sql.h>
#define N 80
EXEC SQL INCLUDE SQLCA;

void Error(void);
void CrearLibro(void);//1
void CrearAutor(void);//2
void EliminarLibro(void);//3
void EliminarAutor(void);//4
void ActualizarLibro(void);//5
void ActualizarAutor(void);//6
void MostrarLibros(void);//7
void MostrarLibrosConAutor(void);//8
void MostrarLibro(void);//9
void MostrarAutor(void);//10

int main(void){

EXEC SQL CONNECT TO bd1 USER user30 USING user30;
Error();

do{

	printf("Elige una opcion:\n");
	printf("1. Insertar un nuevo libro\n
			2. Insertar un nuevo autor\n
			3. Borrar un libro de la base de datos\n
			4. Borrar un autor de la base de datos\n
			5. Actualizar los datos de un libro\n
			6. Actualizar los datos de un autor\n
			7. Mostrar los identificadores, nombres y autores de todos los libros de la base de datos\n
			8. Mostrar los identificadores y nombres de los libros de un determinado autor\n
			9. Mostrar el nombre de un libro\n
			10. Mostrar el nombre de un autor\n
			11. Salir\n");
	printf("=>");
	scanf("%d",&opcion);

	switch(opcion){
		Case 1:
			CrearLibro();
			break;

		Case 2:
			CrearAutor();
			break;
		
		Case 3:
			EliminarLibro();
			break;

		Case 4:
			EliminarAutor();
			break;

		Case 5:
			ActualizarLibro();
			break;

		Case 6:
			ActualizarAutor();
			break;

		Case 7:
			MostrarLibros();
			break;

		Case 8:
			MostrarLibrosConAutor();
			break;

		Case 9:
			MostrarLibro();
			break;

		Case 10:
			MostrarAutor();
			break;

		Case 11:
			printf("¡Adios! Que pases un buen día :)");
			break;

		default:
			printf("Elige una opcion entre las mostradas");
		
	}
	
}while(opcion!=11);

return 0;
}

void Error(void){

	char cadena[1024];

	if(sqlca.sqlcode<0){
		sqlaintp(cadena,1024,80,&sqlca);
		printf("Se ha producido el siguiente error:%s",cadena);
		exit(-1);
	}
}

Void CrearLibro(void){

	EXEC SQL BEGIN DECLARE SECTION;

	int id_libro, precio, ano;
	char nombre_libro[N], editorial[N];

	EXEC SQL END DECLARE SECTION;

	printf("Introduzca el identificador del libro:");
	fflush(stdin);
	scanf("%d", &id_libro);

	printf("Introduzca el nombre:");
	fflush(stdin);
	fgets(nombre_libro, N, stdin);

	printf("Introduzca el precio:");
	fflush(stdin);
	scanf("%d", &precio);

	printf("Introduzca la editorial:");
	fflush(stdin);
	fgets(editorial, N, stdin);

	printf("Introduzca el año de publicación:");
	fflush(stdin);
	scanf("%d", &ano);

	EXEC SQL INSERT INTO LIBROS(ID, nombre, precio, editorial, ano) VALUES (:id_libro, :nombre_libro, :precio, :editorial, :ano);
	Error();
	EXEC SQL COMMIT;
	Error();

}


Void CrearAutor(void){

EXEC SQL BEGIN DECLARE SECTION;

int id_autor;
char nombre_autor[N], fecha_nac[15], lugar_nac[N];

EXEC SQL END DECLARE SECTION;

printf("Introduzca el identificador del autor:");
fflush(stdin);
scanf("%d", &id_autor);

printf("Introduzca el nombre:");
fflush(stdin);
fgets(nombre_autor, N, stdin);

printf("Introduzca la fecha de nacimiento:");
fflush(stdin);
fgets(fecha_nac, N, stdin);

printf("Introduzca el lugar de nacimiento:");
fflush(stdin);
fgets(lugar_nac, N, stdin);

EXEC SQL INSERT INTO AUTORES(ID, nombre, fecha_nac, lugar_nac) VALUES (:id_autor, :nombre_autor, :fecha_nac, :lugar_nac);
Error();
EXEC SQL COMMIT;
Error();
}

void EliminarLibro(void){

EXEC SQL BEGIN DECLARE SECTION;

int id_libro;

EXEC SQL END DECLARE SECTION;

printf("Introduzca el identificador del libro que quiere borrar:");
fflush(stdin);
scanf("%d", &id_libro);

EXEC SQL DELETE FROM LIBROS
	WHERE ID=:id_libro;
Error();
EXEC SQL COMMIT;
Error();

}


void EliminarAutor(void){

EXEC SQL BEGIN DECLARE SECTION;

int id_autor;

EXEC SQL END DECLARE SECTION;

printf("Introduzca el identificador del autor que quiere borrar:");
fflush(stdin);
scanf("%d", &id_autor);

EXEC SQL DELETE FROM AUTORES
	WHERE ID=:id_autor;
Error();
EXEC SQL COMMIT;
Error();
}


void ActualizarLibro(void){

	EXEC SQL BEGIN DECLARE SECTION;

	int id_libro, precio, opcion2;
	char nombre_libro[N], editorial[N], ano[5];

	EXEC SQL END DECLARE SECTION;

	printf("Introduzca el identificador del autor que quiere modificar:");
	fflush(stdin);
	scanf("%d", &id_autor);

	do{
		printf("¿Qué desea modificar?\n\n
			1. Nombre\n
			2. Precio\n
			3. Editorial\n
			4. Fecha de publicación del libro\n
			5. Nada\n");
			
		printf("Seleccione una opción=>");
		scanf("%d", &opcion2);
		
		switch(opcion2){
			Case 1:
				printf("Introduzca el nuevo nombre:");
				fflush(stdin);
				fgets(nombre_libro, N, stdin);
				EXEC SQL UPDATE LIBROS SET nombre= :nombre_libro WHERE ID=:id_libro;
				Error();
				EXEC SQL COMMIT;
				Error();

				break;

			Case 2:
				printf("Introduzca el nuevo precio:");
				fflush(stdin);
				scanf("%d",&precio);
				EXEC SQL UPDATE LIBROS SET precio= :precio WHERE ID=:id_libro;
				Error();
				EXEC SQL COMMIT;
				Error();

			Case 3:
				printf("Introduzca el nuevo nombre de la editorial:");
				fflush(stdin);
				fgets(editorial, N, stdin);
				EXEC SQL UPDATE LIBROS SET editorial= :editorial WHERE ID=:id_libro;
				Error();
				EXEC SQL COMMIT;
				Error();

				break;
			
			Case 4:
				printf("Introduzca el nuevo año de publicación:");
				fflush(stdin);
				fgets(ano, N, stdin);
				EXEC SQL UPDATE LIBROS SET ano= :ano WHERE ID=:id_libro;
				Error();
				EXEC SQL COMMIT;
				Error();
							
				Break;

			Case 5:
				printf("Los nuevos datos del libro han sido actualizados correctamente.");

				break;

			default:
				printf("¡El número introducido no es válido, por favor vuelve a introducirlo: \n!");
			
		}
		
	}while(opcion2!=5);

}


void ActualizarAutor(void){

	EXEC SQL BEGIN DECLARE SECTION;

	int id_autor, opcion2;
	char nombre_autor[N], fecha_nac[10], lugar_nac[N];

	EXEC SQL END DECLARE SECTION;

	printf("Introduzca el identificador del autor que quiere modificar:");
	fflush(stdin);
	scanf("%d", &id_autor);
	
	do{
		printf("¿Qué desea modificar?\n\n
				1. Nombre del autor\n
				2. Fecha de nacimiento del autor\n
				3. Lugar de nacimiento del autor\n
				4. Nada\n");
				
		printf("Introduzca la opción que desea modificar:");
		scanf("%d", &opcion2);
	
		switch(opcion2){
			Case 1:
				printf("Introduzca el nuevo nombre:");
				fflush(stdin);
				fgets(nombre_autor, N, stdin);
				EXEC SQL UPDATE AUTORES SET nombre= :nombre_autor WHERE ID=:id_autor;
				Error();
				EXEC SQL COMMIT;
				Error();

				break;

			Case 2:
				printf("Introduzca la nueva fecha de nacimiento:");
				fflush(stdin);
				fgets(fecha_nac, N, stdin);
				EXEC SQL UPDATE AUTORES SET fecha_nac=:fecha_nac WHERE ID=:id_autor;
				Error();
				EXEC SQL COMMIT;
				Error();

				break;
			
			Case 3:
				printf("Introduzca el nuevo lugar de nacimiento:");
				fflush(stdin);
				fgets(lugar_nac, N, stdin);
				EXEC SQL UPDATE AUTORES SET lugar_nac= :lugar_nac WHERE ID=:id_autor;
				Error();
				EXEC SQL COMMIT;
				Error();
							
				break;

			Case 4:
				printf("¡Ya está!");

				break;

			default:
				printf("¡El número introducido no es válido, por favor vuelve a introducirlo: \n!");
		}
		
	}while(opcion2!=4);
	
}

void MostrarLibros(void){ 

	EXEC SQL BEGIN DECLARE SECTION;

	int id_libro;
	char nombre_libro[N], autor_libro[N];
	EXEC SQL END DECLARE SECTION;
	
   EXEC SQL DECLARE libros_cursor CURSOR FOR 
        SELECT id, nombre, autor 
        FROM LIBROS
 
   EXEC SQL OPEN libros_cursor; 
 
   EXEC SQL WHENEVER NOT FOUND DO break; 
 
   for (;;) 
   { 
      EXEC SQL FETCH libros_cursor INTO :id_libro, :nombre_libro, :autor_libro; 
	  printf("Libro %d=> Nombre:%s , Autor:%s\n", :id_libro, :nombre_libro, :autor_libro);
   } 
   
   EXEC SQL CLOSE libros_cursor; 	
}

void MostrarLibrosConAutor(void){ //8

	EXEC SQL BEGIN DECLARE SECTION;

	int id_libro;
	char nombre_libro[N], autor[N],autor_libro[N];
	EXEC SQL END DECLARE SECTION;
	
	printf("Introduzca el nombre del autor que quiere buscar:");
	fflush(stdin);
	scanf("%s", &autor);
	
   EXEC SQL DECLARE libros_cursor2 CURSOR FOR 
        SELECT id, nombre
        FROM libros
		WHERE autor = :autor
 
   EXEC SQL OPEN libros_cursor2; 
 
   EXEC SQL WHENEVER NOT FOUND DO break; 
 
   for (;;) 
   { 
      EXEC SQL FETCH libros_cursor2 INTO :id_libro, :nombre_libro; 
	  printf("\nLibro %d=> Nombre:%s", :id_libro, :nombre_libro);
   } 
   
   EXEC SQL CLOSE libros_cursor; 	
}


void MostrarLibro(void){

	EXEC SQL BEGIN DECLARE SECTION;

	int id_libro, yn;
	char nombre_libro[N];
	Short nombre_indicador;

	EXEC SQL END DECLARE SECTION;

	printf("Introduzca el identificador del libro que quiere buscar:");
	fflush(stdin);
	scanf("%d", &id_libro);

	EXEC SQL SELECT nombre INTO :nombre_libro INDICATOR :nombre_indicador FROM LIBROS
		WHERE ID= :id_libro;

	if(nombre_indicador <0){
		printf("No se ha encontrado ese nombre en la base de datos");
	}else{
		printf("El nombre del libro %d es: %s", id_libro, nombre_libro);
	}
}


void MostrarAutor(void){

EXEC SQL BEGIN DECLARE SECTION;

int id_autor, yn;
char nombre_autor[N];
Short nombre_indicador ;

EXEC SQL END DECLARE SECTION;

printf("Introduzca el identificador del autor que quiere buscar:");
fflush(stdin);
scanf("%d", &id_autor);

EXEC SQL SELECT nombre INTO :nombre_autor INDICATOR :nombre_indicador FROM AUTORES WHERE ID= :id_autor;

if(nombre_indicador <0){
	printf("No se ha encontrado ese nombre en la base de datos");
}else{
	printf("El nombre del autor %d es: %s", id_autor, nombre_autor);
}

}