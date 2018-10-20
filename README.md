# LARAVEL E-LEARNING PLATFORM

Learn Web Code is an online learning platform developed with Laravel as the main PHP framework.
Please note that this is an ongoing project that it's on its early stages and is under development.

## Below are listed some of the main features:

- The platform has 3 main user roles (Administrator, Teacher and Student role)
- The users can subscribe to two different plans (Monthly Subscription and Yearly Subscription)
- The users can manage their own subscriptions by canceling the subscription plan or by resuming the subscription plan.
- Users can download the invoice generated.
- Administrators can approve or reject courses.
- Administrators can filter courses by name and by status.
- Users can change and update their password details.
- Students can become teachers of the platform.
- Teachers can create, edit, erase their own courses.
- Teachers can view a list of their students.
- Teachers can send emails to students enrolled to their courses.

## Some of the technologies and tools used to develop this project

- PHP
- Laravel
- VueJS 2.5.16
- Bootstrap 4.1.1
- CKEditor 4.10.0
- jQuery 3.3.1
- Vue-Tables-2
- DataTables
- Stripe payment processor
- Faker
- Socialite
- Cashier

## How to use it

1 - Clone the repository to your desktop

2 - Create the database

3 - In the project root create and .env file and copy everything from the .env.example file.

4 - Fill in your database credentials as well as your Mail, GitHub, Facebook and Stripe Keys.

5 - Deploy the project to your cloud server via SSH.

6 - Make sure a database is created and you have properly installed a LEMP server.

7 - Migrate and seed your database typing the following command in your terminal: `php artisan migrate:fresh --seed`

8 - Install Composer

9 - Run the command `composer install` 


## Demo site

[LEARN WEB CODE](https://learnwebcode.online)


## Todo

- Develop the Curriculum for each course (Content).
- Logic for the video courses. 
- Form to add the video courses to each lesson.
- Develop the view to show the videos for each lesson
- Routing and security to display the video courses.



