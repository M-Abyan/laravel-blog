
# Laravel Inertia Blog
Hi this is my project. I'm using laravel, Inertia Vue3, Tailwind, and Tiptap.

## Features
- **Auth**
- **Likes**
- **Comments**
- **And Others**

## Setup Instructions

Follow these steps to set up and run the project locally:

1. **Clone the Repository**:
   ```bash
   git clone <repository-url>
   ```

2. **Install Dependencies**:
   - Navigate to the Laravel backend directory:
     ```bash
     cd laravel-backend
     ```
   - Install PHP dependencies using Composer:
     ```bash
     composer install
     ```
   - Navigate to the Vue.js frontend directory:
     ```bash
     cd vue-frontend
     ```
   - Install Node.js dependencies using npm:
     ```bash
     npm install
     ```

3. **Configure Environment Variables**:
   - Copy the `.env.example` file in the Laravel backend directory to `.env` and update the database credentials.
   - Ensure your database server is running and create a new database for the application.

4. **Run Migrations**:
   - Execute Laravel migrations and also seeder(optional) to create the necessary database tables:
     ```bash
     php artisan migrate
     ```

5. **Compile Assets**:
   - Compile Vue.js assets for production:
     ```bash
     npm run build
     ```

6. **Serve the Application**:
   - Start the Laravel development server:
     ```bash
     php artisan serve
     ```
   - Access the application in your web browser at `http://localhost:8000`.

![Screenshot 2024-04-20 135215](https://github.com/M-Abyan/laravel-blog/assets/95427240/02faef09-7089-4e83-8dfa-edda645cf3b9)
![Screenshot 2024-04-20 135314](https://github.com/M-Abyan/laravel-blog/assets/95427240/28fce608-f675-43ea-9f3c-4dedbc31250c)
![Screenshot 2024-04-20 135408](https://github.com/M-Abyan/laravel-blog/assets/95427240/81ea3ff7-b4a5-4155-a6a3-f704428d5098)


