# Proyecto Farmacia CRUD

Este es un proyecto de Laravel que utiliza Docker para facilitar su despliegue en diferentes entornos.

## Instalación

1. Clonar el repositorio:

```
git clone https://github.com/leasabo/farmacia.git
```

2. Entrar al directorio del proyecto:

```
cd farma
```

3. Copiar el archivo `.env.example` a `.env`:

```
cp .env.example .env
```

4. Configurar las variables de entorno en el archivo `.env` según los datos suministrados por correo.

5. Construir y ejecutar los contenedores de Docker:

```
docker-compose up -d --build
```

6. Acceder al proyecto en el navegador web en la dirección `http://localhost:8080` para corroborar que el proyecto haya sido levantado exitosamente. A continuación se puede usar Postman o un programa similar par aprobar los endpoints de la API.

## Endpoints de la API

El proyecto cuenta con los siguientes endpoints para la API:

- `POST /farmacia`: Crea una nueva farmacia. Se debe enviar un JSON con la información de la farmacia a crear en el cuerpo de la petición. Retorna un JSON con la información de la farmacia creada.
    Ejemplo:
    {
    "nombre":"Farmacia la Tradición SCS",
    "direccion":"La Rioja 798, Corrientes",
    "latitud":"-27.46631740",
    "longitud":"-58.85149940"
    }

- `GET /farmacia/{id}`: Obtiene la información de una farmacia por su ID. Retorna un JSON con la información de la farmacia encontrada.

- `GET /farmacia`: Obtiene la farmacia más cercana a una ubicación dada. Se debe enviar los parámetros `lat` y `lon` con la ubicación en el query string de la petición. Retorna un JSON con la información de la farmacia encontrada.

## Pruebas Unitarias

El proyecto cuenta con pruebas unitarias para las operaciones de creación de farmacia:

- `testCrearFarmaciaExitoso()`: Prueba la creación exitosa de una farmacia.

- `testCrearFarmaciaError()`: Prueba la creación de una farmacia con información faltante.

- `FarmaciaCercanaTest` : Prueba la muestra de la farmacia más cercana a la ciudad de Belén, Catamarca. Para probar este test, previamente se tienen que tener cargadas estas farmacias:

+----------------------------+-----------------------------------------+--------------+--------------+
| nombre                     | direccion                               | latitud      | longitud     |
+----------------------------+-----------------------------------------+--------------+--------------+
| Polini                     | Mariano Moreno 197, Sáenz Peña, Chaco   | -26.79235540 | -60.44526770 |
| Schvening                  | Avellaneda 138, Coronel Du Graty, Chaco | -27.68551130 | -60.91201020 |
| Farmar                     | Av. San Martín 221, Resistencia, Chaco  | -27.45689950 | -58.98621540 |
| Farmacia la Tradición SCS  | La Rioja 798, Corrientes                | -27.46631740 | -58.85149940 |
+----------------------------+-----------------------------------------+--------------+--------------+

Para ejecutar las pruebas unitarias, se debe ejecutar el siguiente comando:

```
docker-compose exec app php artisan test
```

## Listado de TODO's:
- Definir condiciones para los valores de la URL en las rutas.
- Definir e implementar excepciones propias.
- Evaluar la posibilidad de crear otras tablas (para desglosar la dirección por ejemplo).
- Contemplar distintos casos de error y tratarlos con excepciones propias.
- Limitar lo que el usuario pueda ingresar como valores.
- Documentar la API con Swagger (quedó instalado el paquete, solo faltó configurarlo).
- Evaluar el estándar y el linter utilizado para elegir mejores. En este caso se utilizó PSR-12 con PHP_CodeSniffer .
- Plantear un esquema de bifurcación. Podría ser git-flow, pero con un proyecto de esta envergadura no creo que valga la pena. En principio se pretendió solamente usar la rama master. Después se creyó mejor utilizar una rama para MVC y otra para clean architecture (trasladando toda la lógica a esta nueva arquitectura).
- Terminar el desarrollo con el enfoque de multicapas.
- Utilizar Ngnix en vez de Apache.
- Correr los contenedores en una instancia virtual de Oracle Cloud que tengo en uso.
- Renombrar las variables, entidades y distintos conceptos a inglés.
