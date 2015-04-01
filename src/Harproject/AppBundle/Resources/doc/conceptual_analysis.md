# Conceptual Analysis


## Overview
![MCD](https://raw.githubusercontent.com/kkuetnet/Harproject/develop/src/Harproject/AppBundle/Resources/doc/MCD.png)

## Context
Harproject is a software to easily manage your projects. Its main goal is to help users to evaluate each task's durations with suggestions due to own statistics. 

*In the following document, the key words "MUST", "MUST NOT", "REQUIRED", "SHALL", "SHALL NOT", "SHOULD", "SHOULD NOT", "RECOMMENDED", "MAY", and "OPTIONAL" in this document are to be interpreted as described in RFC 2119.*

### Group: 
- A Group is a collection of permissions.
- A Group MUST be identified by a unique name
- Administrators can create/read/update/delete each one.
- Each Users can belongs to several Groups.

**NOTE:** Should be renamed to **PermissionGroup** in my opinion

### Project:
- A **Project** MUST have a collection of **Tasks**.
- A **Project** MUST have a collection of **Members**.

### User:
- A **User** MAY be assigned to a **Project** with given persmissions via a **Member**

### Member:
- **Member** MUST be a registered **User**.
- **Member** MUST be assigned to one **Project**.
- **Member** MUST be assigned to one  **Group**.
 - *ex:* Member1 = { John, Project1, Developer }
 - *ex:* Member2 = { John, Project1, Customer }
 - *ex:* Member3 = { John, Project2, Developer }
 - *ex:* Member4 = { John, Project2, Customer }
- **Member** 's name MUST be the name of the corresponding **User**

- **User** can belongs to several **Groups** in one Project.
 - *ex:* John is Dev in Prj1 and John is also Client in Prj1

- **Member** MAY be assigned to serveral **Tasks**.
- **Member** MUST be assigned to one **Projects**.
- **Member** MAY be an author of several **Tasks**.
- **Member** MAY be an author of several **Tickets**. 
- **Member** MAY update the Status of any of it's assigned **Task**.
- **Member** MAY get several **TimeTrackers**. 

### Task
- **Task** MUST refer to one **Project**.
- **Task** MUST refer to one **Member** known as author.
- **Task** MAY refer to several **Tags**.
- **Task** MAY be assigned to several **Members**.
- **Task** MAY refer to several **Tickets**.
- **Task** MAY refer to one other **Task** known as ParentTask.
- **Task** MUST refer to one or more **Status**.
- **Task** current **Status** is defined by the latest refered **Status**.

### TimeTracker
- **TimeTracker** MAY refer to several **Tags**.
- **TimeTracker** MAY have an comment.
- **TimeTracker** MUST refer to one **Member**.
- **TimeTracker** MUST refer to one **Task**.
- **TimeTracker** MUST have a start date.
- **TimeTracker** MAY jave an end date.

### Ticket
- **Ticket** MAY refer to several **Tags**.
- **Ticket** MAY be refered by several **Tasks**.
- **Ticket** MUST refer to one **Member** known as author.

### Status
- **Status** is the state of **Task**.
- **Status** MUST refer to one **Member**.
- **Status** MUST refer to one **Task**.
- **Status** MUST have a creation date.
