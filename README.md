# API Product Management

API terdiri dari auth, category, dan product.  
`CRUD` Products dan Categories menggunakan token.

## Autentikasi

API ini menggunakan autentikasi Laravel Passport. Sebelum Anda dapat mengakses beberapa endpoint, perlu mendapatkan token akses terlebih dahulu. Berikut adalah langkah-langkah untuk mendapatkan token akses:

## Endpoint AUTH

### 1. Register

-   **URL**: `/api/register`
-   **Metode**: POST
-   **Deskripsi**: Mendaftarkan pengguna baru dengan data yang diberikan.
-   **Parameter Body**:
    -   `name` (required).
    -   `email` (required,unique).
    -   `password` (required).
-   **Contoh Permintaan**:  
    POST /api/login  
    Content-Type: application/json
    ```json
    {
        "name": "your_name",
        "email": "user@example.com",
        "password": "your_password"
    }
    ```
-   **Response**:  
    **_`Success (201 Created)`_**
    ```json
    {
        "status": true,
        "message": "User logged in successfully",
        "data": {
            "user": "Admin",
            "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjo"
        }
    }
    ```
    **_`Error Validation (400 Bad Request)`_**
    ```json
    {
        "status": false,
        "message": {
            "errors": [
                {
                    "name": ["The name field is required."],
                    "email": ["The email field is required."],
                    "password": ["The password field is required."]
                }
            ]
        }
    }
    ```

### 2. Login

-   **URL**: `/api/login`
-   **Metode**: POST
-   **Deskripsi**: Endpoint untuk melakukan proses login dan mendapatkan token akses.
-   **Parameter Body**:
    -   `email` (required).
    -   `password` (required).
-   **Contoh Permintaan**:  
    POST /api/login  
    Content-Type: application/json
    ```json
    {
        "email": "user@example.com",
        "password": "your_password"
    }
    ```
-   **Response**:  
    **_`Success (200 OK)`_**
    ```json
    {
        "status": true,
        "message": "User logged in successfully",
        "data": {
            "user": "Admin",
            "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjo"
        }
    }
    ```
    **_`Error (401 Anauthorized)`_**
    ```json
    {
        "status": false,
        "message": "Invalid credentials"
    }
    ```

## Endpoint Categories

### 1. Menampilkan Semua Daftar Categori

-   **URL**: `/categories`
-   **Metode**: GET
-   **Deskripsi**: Mendapatkan daftar semua categori yang tersedia.
-   **Header**:
    -   `Authorization`: access_token
-   **Permintaan** :
    -   Tidak ada parameter khusus yang diperlukan.
-   **_Response_**  
    **_`Sukses (200 OK)`_**
    ```json
    {
        "status": "true",
        "message": "OK",
        "data": [
            {
                "id": 1,
                "name": "Category 1",
                "created_at": "2023-07-25T23:37:40.000000Z",
                "updated_at": "2023-07-25T23:37:40.000000Z"
            },
            {
                "id": 2,
                "name": "Category 2",
                "created_at": "2023-07-25T23:37:40.000000Z",
                "updated_at": "2023-07-25T23:37:40.000000Z"
            }
        ]
    }
    ```

### 2. Membuat Atau Menambah Categori (Create)

-   **URL**: `/api/categories`
-   **Metode**: POST
-   **Deskripsi**: Endpoint untuk Membuat Categori baru dengan data yang diberikan.
-   **Parameter Body**:
    -   `name` (required, unique).
-   **Header**:
    -   `Authorization`: access_token
-   **Contoh Permintaan**:  
    POST /api/categories  
    Content-Type: application/json
    ```json
    {
        "name": "New Category 3"
    }
    ```
-   **Response**:  
    **_`Success (201 Created)`_**
    ```json
    {
        "status": true,
        "message": "Data successfully created",
        "data": {
            "name": "New Category 3",
            "updated_at": "2023-07-27T13:57:50.000000Z",
            "created_at": "2023-07-27T13:57:50.000000Z",
            "id": 3
        }
    }
    ```
    **_`Error Validation (400 Bad Request)`_**
    ```json
    {
        "status": false,
        "message": {
            "errors": [
                {
                    "name": ["The name field is required."]
                }
            ]
        }
    }
    ```

### 3. Mendapatkan Categori Berdasarkan ID

-   **URL**: `/api/categories/{id}`
-   **Metode**: GET
-   **Deskripsi**: Endpoint untuk Mendpatkan Categori berdasarkan ID Categori.
-   **Parameter URL**:
    -   `id` (required : id categori yang ingin di tampilkan).
-   **Header**:
    -   `Authorization`: access_token
-   **Response**:  
    **_`Success (200 OK)`_**
    ```json
    {
        "status": true,
        "message": "OK",
        "data": {
            "id": 2,
            "name": "Category 2",
            "created_at": "2023-07-26T15:45:50.000000Z",
            "updated_at": "2023-07-26T15:45:50.000000Z",
            "products": [
                {
                    "id": 4,
                    "category_id": 2,
                    "name": "product D",
                    "description": "desc product D",
                    "price": "12131",
                    "stock": 200,
                    "created_at": "2023-07-26T16:01:06.000000Z",
                    "updated_at": "2023-07-26T16:01:06.000000Z"
                },
                {
                    "id": 5,
                    "category_id": 2,
                    "name": "product E",
                    "description": "desc product E",
                    "price": "12131",
                    "stock": 200,
                    "created_at": "2023-07-27T13:55:47.000000Z",
                    "updated_at": "2023-07-27T13:55:47.000000Z"
                },
                {
                    "id": 6,
                    "category_id": 2,
                    "name": "product F",
                    "description": "desc product F",
                    "price": "12131",
                    "stock": 200,
                    "created_at": "2023-07-27T13:57:50.000000Z",
                    "updated_at": "2023-07-27T13:57:50.000000Z"
                }
            ]
        }
    }
    ```
    **_`Data Not Found (404 Not Found)`_**
    ```json
    {
        "status": false,
        "message": "Data not found"
    }
    ```

### 3. Merubah Data Category (Update)

-   **URL**: `/api/categories/{id}`
-   **Metode**: PUT
-   **Deskripsi**: Endpoint untuk update categori dengan data yang diberikan berdasarkan id.
-   **Parameter URL**:
    -   `id` (required : id categori yang ingin di edit).
-   **Parameter Body**:
    -   `name` (required, unique).
-   **Header**:
    -   `Authorization`: access_token
-   **Contoh Permintaan**:  
    PUT /api/categories{id}  
    Content-Type: application/json
    ```json
    {
        "name": "Update Category C"
    }
    ```
-   **Response**:  
    **_`Success (200 OK)`_**
    ```json
    {
        "status": true,
        "message": "Data successfully updated",
        "data": {
            "id": 1
            "name": "Update Category C",
            "updated_at": "2023-07-27T13:57:50.000000Z",
            "created_at": "2023-07-27T13:58:50.000000Z",
        }
    }
    ```
    **_`Error Validation (400 Bad Request)`_**
    ```json
    {
        "status": false,
        "message": {
            "errors": [
                {
                    "name": ["The name has already been taken."]
                }
            ]
        }
    }
    ```

### 3. Hapus Categori Berdasarkan ID (Delete)

-   **URL**: `/api/categories/{id}`
-   **Metode**: DELETE
-   **Deskripsi**: Endpoint untuk menghapus categori berdasarkan ID Categori.
-   **Parameter URL**:
    -   `id` (required : id categori yang ingin di hapus).
-   **Header**:
    -   `Authorization`: access_token
-   **Response**:  
    **_`Success (200 OK)`_**
    ```json
    {
        "status": true,
        "message": "Data successfully deleted"
    }
    ```

## Endpoint Products

### 1. Mendapatkan Daftar Produk

-   **URL**: `/products`
-   **Metode**: GET
-   **Deskripsi**: Mendapatkan daftar semua produk yang tersedia.
-   **Header**:
    -   `Authorization`: access_token
-   **Permintaan** :
    -   Tidak ada parameter khusus yang diperlukan.
-   **_Response_**  
    **_`Sukses (200 OK)`_**
    ```json
    {
        "status": "true",
        "message": "OK",
        "data": [
            {
                "id": 1,
                "category_id": 1,
                "name": "Product A",
                "description": "Description of Product A",
                "price": 100,
                "stock": 200
                "created_at": "2023-07-25T23:37:40.000000Z",
                "updated_at": "2023-07-25T23:37:40.000000Z",
                "category": {
                    "id": 1,
                    "name": "Category 1"
                }
            },
            {
                "id": 2,
                "category_id": 2,
                "name": "Product B",
                "description": "Description of Product B",
                "price": 100,"stock": 200
                "created_at": "2023-07-25T23:37:40.000000Z",
                "updated_at": "2023-07-25T23:37:40.000000Z",
                "category": {
                    "id": 2,
                    "name": "Category B"
                }
            }
        ]
    }
    ```

### 2. Membuat Atau Menambah Produk (Create)

-   **URL**: `/api/products`
-   **Metode**: POST
-   **Deskripsi**: Endpoint untuk Membuat produk baru dengan data yang diberikan.
-   **Parameter Body**:
    -   `name` (required).
    -   `category_id` (required).
    -   `description`.
    -   `price` (required).
    -   `stock`.
-   **Header**:
    -   `Authorization`: access_token
-   **Contoh Permintaan**:  
    POST /api/products  
    Content-Type: application/json
    ```json
    {
        "name": "New Product",
        "category_id": 2,
        "description": "Description of New Product",
        "price": "12131",
        "stock": "200"
    }
    ```
-   **Response**:  
    **_`Success (201 Created)`_**
    ```json
    {
        "status": true,
        "message": "Data successfully created",
        "data": {
            "name": "New Product C",
            "category_id": 2,
            "description": "Description of New Product",
            "price": "12131",
            "stock": "200",
            "updated_at": "2023-07-27T13:57:50.000000Z",
            "created_at": "2023-07-27T13:57:50.000000Z",
            "id": 12
        }
    }
    ```
    **_`Error Validation (400 Bad Request)`_**
    ```json
    {
        "status": false,
        "message": {
            "errors": [
                {
                    "name": ["The name field is required."],
                    "category_id": ["The category id field is required."],
                    "price": ["The price field is required."]
                }
            ]
        }
    }
    ```

### 3. Mendapatkan Produk Berdasarkan ID

-   **URL**: `/api/products/{id}`
-   **Metode**: GET
-   **Deskripsi**: Endpoint untuk Mendpatkan produk berdasarkan ID Product.
-   **Parameter URL**:
    -   `id` (required : id product yang ingin di tampilkan).
-   **Header**:
    -   `Authorization`: access_token
-   **Response**:  
    **_`Success (200 OK)`_**
    ```json
    {
        "status": true,
        "message": "OK",
        "data": {
            "id": 3,
            "name": "product C",
            "category_id": 2,
            "description": "Description of Product",
            "price": "12131",
            "stock": "200",
            "updated_at": "2023-07-27T13:57:50.000000Z",
            "created_at": "2023-07-27T13:57:50.000000Z",
            "category": {
                "id": 2,
                "name": "Category 2"
            }
        }
    }
    ```
    **_`Data Not Found (404 Not Found)`_**
    ```json
    {
        "status": false,
        "message": "Data not found"
    }
    ```

### 3. Merubah Data Product (Update)

-   **URL**: `/api/products/{id}`
-   **Metode**: PUT
-   **Deskripsi**: Endpoint untuk edit produk berdasarkan id dengan data yang diberikan.
-   **Parameter URL**:
    -   `id` (required : id product yang ingin di edit).
-   **Parameter Body**:
    -   `name` (required, unique).
    -   `category_id` (required).
    -   `description`.
    -   `price` (required).
    -   `stock`.
-   **Header**:
    -   `Authorization`: access_token
-   **Contoh Permintaan**:
    PUT /api/Products{id}
    Content-Type: application/json
    ```json
    {
        "name": "Update Product A",
        "category_id": 2,
        "description": "Description of Product",
        "price": "20000",
        "stock": "200"
    }
    ```
-   **Response**:  
    **_`Success (200 OK)`_**
    ```json
    {
        "status": true,
        "message": "Data successfully updated",
        "data": {
            "id": 1
            "name": "Update Product A",
            "category_id": 2,
            "description": "Description of Product",
            "price": "20000",
            "stock": "200",
            "updated_at": "2023-07-27T13:57:50.000000Z",
            "created_at": "2023-07-27T13:58:50.000000Z",
        }
    }
    ```
    **_`Error Validation (400 Bad Request)`_**
    ```json
    {
        "status": false,
        "message": {
            "errors": [
                {
                    "name": ["The name has already been taken."],
                    "category_id": ["The category id field is required."],
                    "price": ["The price field is required."]
                }
            ]
        }
    }
    ```

### 3. Hapus Produk Berdasarkan ID (Delete)

-   **URL**: `/api/products/{id}`
-   **Metode**: DELETE
-   **Deskripsi**: Endpoint untuk menghapus produk berdasarkan ID Product.
-   **Parameter URL**:
    -   `id` (required : id product yang ingin di hapus).
-   **Header**:
    -   `Authorization`: access_token
-   **Response**:  
    **_`Success (200 OK)`_**
    ```json
    {
        "status": true,
        "message": "Data successfully deleted"
    }
    ```
