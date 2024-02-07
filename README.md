# SonicSpectator Social Network

This repository contains the source code for SonicSpectator, a simple social network designed for concert enthusiasts.
The project was developed by Nicolò D'Addabbo and Leonardo Magnani as part of the Web Technologies course at my university.

## Technology Stack
  - LAMP (Linux, Apache, MySQL, PHP): Utilized as the development environment.
  - Composer: Used for PHP dependency management.

## Setup

To run the project locally, follow these steps:

  1. Ensure you have Docker, Docker Compose and Composer installed on your system.
  2. Clone this repository to your computer.
  3. Open a terminal in the project directory.
  4. Execute the command `composer install`.
  5. Execute the command `docker-compose up --build`.
  6. Access the social network through the browser at `http://localhost:8080`.

## Troubleshooting

If you encounter problems in uploading images, execute the following commands in the project directory: 
  1. `chmod 777 public/assets`
  2. `chmod 777 public/assets/*`
