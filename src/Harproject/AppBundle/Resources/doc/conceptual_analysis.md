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
- **Member** is a registered **User** which belongs to a **Project** with one **Group**. 
- **User** can belongs to several **Groups** in one Project.
 - *ex:* John is Dev in Prj1 and John is also Dev in Prj1
- **Member** can be assigned to serveral **Tasks**.
- **Member** can be assigned to serveral **Projects**.
- **Member** can be an author of several **Tasks**.
- **Member** can be an author of several **Tickets**. 
- **Member** can update the Status of any of it's assigned **Task**.
- **Member** can get several **TimeTrackers**. 

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
