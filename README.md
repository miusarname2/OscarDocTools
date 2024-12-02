### **Documentation of the Project: OscarDocTools**

---

## **OscarDocTools**  
**OscarDocTools** is a solution for converting Word, Excel, and image (JPG/PNG) files to PDF format using PHP. It is designed to be flexible and extensible, providing a robust backend for conversion tasks.

---

### **Features**  
- Convert images (JPG, PNG) to PDF while preserving dimensions and quality.  
- Convert Excel documents to PDF using PhpSpreadsheet.  
- Convert Word documents to PDF via an API service.  
- Exception handling and support for different file types.  

---

## **Installation**  

### **Prerequisites**  
1. PHP 5.6 or higher.  
2. Composer installed.  
3. PHP extensions: `curl`, `gd`, and `mbstring`.  
4. Web server (e.g., Apache or Nginx).  

### **Installation Steps**  
1. **Clone this repository:**  
   ```bash
   git clone https://github.com/miusarname2/OscarDocTools
   cd OscarDocTools
   ```

2. **Install dependencies with Composer:**  
   ```bash
   composer install
   ```

3. **Ensure that the `output` folder is writable:**  
   ```bash
   chmod -R 777 ./output
   ```

4. **Configure the Word to PDF service:**  
   - The service should be available at `http://192.168.0.51:3000/convert`. If you are using a different URL, update `$serviceUrl` in the `UltimateClassConverter` class.

5. **Configure your web server:**  
   Make sure your web server is pointed to the main file (e.g., `index.php`).

---

### **Project Structure**  

```
OscarDocTools/
├── src/
│   ├── index.html                  # The entrance from the ‘front’ side
│   ├── convert.php                 # Entry point for requests
│   ├── output/                     # Folder for generated PDF files
│   ├── fpdf181/                    # FPDF library
│   ├── UltimateClassConverter.php  # The main conversion class
│   └── index.php                   # The first experiment
├── vendor/                         # Dependencies installed by Composer
└── composer.json                   # Composer configuration file
```

---

## **How to Start**  

1. **Run a local PHP server:**  
   ```bash
   php -S localhost:8000
   ```

2. **Upload a file from a client (Postman or web form).**  
   Ensure the request points to `http://localhost:8000/index.html`.  

3. **Retrieve the generated PDF file from the URL provided in the response.**

---

## **Contributions**  
Contributions are welcome. Please open an issue or pull request to suggest improvements or fix bugs.  

---

## **License**  
This project is licensed under the MIT License.  

### **Documentación del Proyecto: OscarDocTools**

---

## **OscarDocTools**  
**OscarDocTools** es una solución para convertir archivos Word, Excel e imágenes (JPG/PNG) a formato PDF utilizando PHP. Está diseñada para ser flexible y extensible, proporcionando un backend robusto para tareas de conversión.

---

### **Características**  
- Convertir imágenes (JPG, PNG) a PDF manteniendo las dimensiones y calidad.  
- Convertir documentos Excel a PDF utilizando PhpSpreadsheet.  
- Convertir documentos Word a PDF mediante un servicio API.  
- Manejo de excepciones y soporte para diferentes tipos de archivos.  

---

## **Instalación**  

### **Requisitos previos**  
1. PHP 5.6 o superior.  
2. Composer instalado.  
3. Extensiones de PHP: `curl`, `gd`, y `mbstring`.  
4. Servidor web (por ejemplo, Apache o Nginx).  

### **Pasos de instalación**  
1. **Clona este repositorio:**  
   ```bash
   git clone https://github.com/miusarname2/OscarDocTools
   cd OscarDocTools
   ```

2. **Instala las dependencias con Composer:**  
   ```bash
   composer install
   ```

3. **Asegúrate de que la carpeta `output` tenga permisos de escritura:**  
   ```bash
   chmod -R 777 ./output
   ```

4. **Configura el servicio de conversión Word a PDF:**  
   - El servicio debe estar disponible en `http://192.168.0.51:3000/convert`. Si usas otra URL, actualiza `$serviceUrl` en la clase `UltimateClassConverter`.

5. **Configura tu servidor web:**  
   Asegúrate de apuntar el directorio raíz a la ubicación del archivo principal (por ejemplo, `index.php`).

---

## **Cómo usar**  

### **Interfaz**  
El proyecto funciona como un backend para subir archivos y realizar conversiones. A continuación, se describe el flujo básico:

1. **Realiza una solicitud POST** con los siguientes campos:  
   - `fileType`: Tipo de archivo a convertir (`word`, `excel`, `jpg`, `png`).  
   - `file`: Archivo a convertir (subido a través de un formulario HTML o herramienta como Postman).  

2. **Ejemplo de solicitud usando cURL:**  
   ```bash
   curl -X POST -F "fileType=word" -F "file=@path/to/your/file.docx" http://localhost/convert.php
   ```

3. **Respuesta esperada (éxito):**  
   ```json
   {
       "success": true,
       "fileUrl": "output/nombreArchivo.pdf"
   }
   ```

4. **Respuesta esperada (error):**  
   ```json
   {
       "success": false,
       "message": "Descripción del error."
   }
   ```

---

### **Estructura del proyecto**  

```
OscarDocTools/
├── src/
│   ├── index.html                  # La entrada desde el 'Front'
│   ├── convert.php                 # Punto de entrada de solicitudes
│   ├── output/                     # Carpeta para los archivos PDF generados
│   ├── fpdf181/                    # FPDF library
│   ├── UltimateClassConverter.php  # La clase principal de conversión
│   └── index.php                   # El primer experimento
├── vendor/                         # Dependencias instaladas de Composer
└── composer.json                   # Archivo de configuración de Composer
```

---

## **Cómo iniciar**  

1. **Ejecuta un servidor PHP local:**  
   ```bash
   php -S localhost:8000
   ```

2. **Sube un archivo desde un cliente (Postman o formulario web).**  
   Asegúrate de que la solicitud apunte a `http://localhost:8000/index.php`.  

3. **Obtén el archivo PDF generado desde la URL proporcionada en la respuesta.**

---

## **Contribuciones**  
Las contribuciones son bienvenidas. Por favor, abre un issue o un pull request para sugerir mejoras o corregir errores.  

---

## **Licencia**  
Este proyecto está bajo la licencia MIT.  
