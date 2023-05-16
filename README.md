# Prueba Técnica Laravel

El objetivo de esta prueba técnica es evaluar tus habilidades en Laravel y tu capacidad para tomar decisiones lógicas en la programación cuando no se tiene un requerimiento detallado. El tiempo asignado para completar la prueba es de 72 horas.

## Alcance del Sistema

El sistema a construir es un mínimo viable para un parqueadero de vehículos (automóviles, motocicletas, bicicletas, etc.) que permita el registro de nuevos clientes y sus respectivos vehículos.

## Características

El sistema debe incluir un botón para validar y guardar los datos en la base de datos. Las validaciones requeridas son las siguientes:

### Registro de Clientes

- 2 campos obligatorios

### Registro de Vehículos

- 1 campo único
- 1 campo con formato específico (puede ser el mismo campo de validación única)

La base de datos debe crearse utilizando migraciones.

## Requerimientos Funcionales

- El cobro por parqueo se realiza por hora.
- Las tarifas varían entre tipos de vehículos (por ejemplo, automóviles = $2, motocicletas = $50, etc.).
- Si un vehículo se retira antes de una hora, se cobra el valor proporcional.
- Si un cliente ingresa el mismo vehículo 3 veces, no se le cobrará el valor del parqueo a partir de la cuarta vez, siempre y cuando lo retire el mismo día.
- Si un cliente ingresa vehículos de todas las categorías en el mes actual, el primer día del siguiente mes se le otorgará un día gratis de parqueo.

## Bonus

Reutilización de componentes para funciones o vistas repetitivas, si es aplicable.

## Requisitos

- Laravel 8.x
- PHP 7.4 o superior
- Livewire
- MySQL

## Entregable

Por favor, comprime el proyecto completo en un archivo ZIP para su entrega.

# Solución planteada

## Resumen

Este proyecto es un sistema de parqueadero de vehículos desarrollado en Laravel que cumple con los siguientes requerimientos:

- Registro de clientes y vehículos con validaciones específicas.
- Cobro por hora según la tarifa de cada tipo de vehículo.
- Cobro proporcional si un vehículo se retira antes de una hora.
- Exención de cobro a partir de la cuarta entrada del mismo vehículo en un mismo día.
- Día gratis de parqueo para un cliente que ingrese vehículos de todas las categorías en el mes actual.

## Tests

Se han implementado pruebas unitarias y de características (feature tests) para asegurar el correcto funcionamiento del sistema y verificar que se cumplen los requerimientos. Estas pruebas cubren aspectos como la validación de formularios, el funcionamiento de los controladores y la interacción con la base de datos.

![Batería de Tests](/public/tdd.png)

## Componente DataTable

El proyecto utiliza un componente livewire DataTable para implementar las vistas de índice de cada CRUD. Este componente permite mostrar datos de una tabla de manera dinámica para todos las entidades, fue creado para ser reutilizado en los index de éste proyecto.

## Componente Register

El componente Register es responsable de gestionar el proceso de registro de vehículos en el parqueadero. Permite buscar vehículos por placa o cliente, seleccionar un vehículo, registrar la entrada y salida del vehículo, calcular el monto a cobrar y actualizar los registros correspondientes. Este componente utiliza la biblioteca Carbon para realizar cálculos de fechas y horas, asegurando un cálculo preciso del tiempo de estacionamiento y el monto a cobrar.

El componente Register ha sido sometido a pruebas unitarias para garantizar su correcto funcionamiento y cumplimiento de los requerimientos establecidos.

En resumen, este proyecto demuestra la capacidad para desarrollar un sistema de funcional utilizando Laravel y Livewire. Se han aplicado buenas prácticas de desarrollo, incluyendo la implementación de pruebas para asegurar la calidad del código. El uso del componente DataTable y el componente Register proporcionan una experiencia de usuario eficiente y una gestión eficaz del registro de vehículos en el parqueadero.
