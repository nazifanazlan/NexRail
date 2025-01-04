# NexRail Railway System

Welcome to the NexRail Railway System project. This project includes various PHP scripts for managing a railway system, including user registration, login, and email verification.

## Project Structure

- `register.php`: Handles user registration and sends verification emails.
- `verify_email.php`: Verifies user email addresses.
- `login.php`: Handles user login.
- `seat_selection.php`: Manages seat selection.
- `price.php`: Displays pricing information.
- `customersupport.php`: Provides customer support.
- `css`: Contains the CSS styles for the project.
- `javascript`: Contains JavaScript code for the project.

## Getting Started with Git and GitHub

### Download Git

If you don't have Git installed, you can download it from [git-scm.com](https://git-scm.com/). Follow the installation instructions for your operating system.

### Apply Git to the Current Repository

```sh
# CAUTION: Make sure your terminal are located to your previous project folder or empty folder before cloning/pulling to avoid some issues.
```
If you haven't initialized a Git repository in your project directory, you can do so with the following commands:

```sh
cd /path/to/your/project
git init
```

### Cloning the Repository

To clone the repository, use the following command: (do for the first time only)

```sh
git clone https://github.com/GohTeckAn/NexRail.git
```

### Pulling the Latest Changes from Remote Repository

To pull the latest update from GitHub: (do for everytime except the first time)

```sh
git pull origin main
```

### Adding, Committing, and Pushing Changes

To add and commit changes to your repository, use the following commands: (to save your files and upload to GitHub)

```sh
# The remote add origin and branch command only need to perform once when upload files
```
```sh
git remote add origin https://github.com/GohTeckAn/NexRail.git
git branch -M main

git add .
git commit -m "Your commit message"
git push origin main
```

### Other Useful Commands

To check the status of your repository:

```sh
git status
```

To view the commit history:

```sh
git log
```