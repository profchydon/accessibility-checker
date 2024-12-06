### App Setup and Usage Guide

  

#### Overview

This project consists of a backend and frontend component that can be run locally using Docker. The backend is built with Laravel, and the frontend is built with Next.js. The backend exposes an API, and the frontend communicates with it. This README will guide you through the setup process, tool requirements, and how to use the app.

  

#### Tool Requirements

Before setting up the project, ensure you have the following tools installed:

-  **Docker**

You need Docker to build and run the containers for both the frontend and backend.

-  **Git** 

To clone the repository and manage the versioning of your app.

**Install Git**: [Git Installation Guide](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git)

#### Setup Instructions

Follow these steps to set up and run the application locally.

 
**Step 1: Clone the Repository**

If you haven't already cloned the repository, do so using Git:

  

```bash

git  clone  https://github.com/profchydon/accessibility-checker.git

cd  accessibility-checker
```



**Step 2: Start the applications**

Make sure you are in the accessibility-checker root directory, and run the command
  
```bash
/.start.sh
```

This will start both the backend and frontend services. By default:
  

The backend will be accessible at http://localhost:8000.

The frontend will be accessible at http://localhost:3000.


**Step 3: Access the Application**

 
Once the services are running:

Navigate to http://localhost:3000/analyzer in your browser to view the frontend application.

The frontend will interact with the backend API at http://localhost:8000.