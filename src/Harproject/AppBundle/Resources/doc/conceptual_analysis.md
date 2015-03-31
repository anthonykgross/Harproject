# Conceptual Analysis

![MCD](https://raw.githubusercontent.com/kkuetnet/Harproject/develop/src/Harproject/AppBundle/Resources/doc/MCD.png)

## Context
Harproject is a software to easily manage your projects. Its main goal is to help users to evaluate each task's durations with suggestions due to own statistics. 

### Group
- Group is a collection of permissions defined by a group's name.
- Administrators can create/read/update/delete each one.
- Each Users can belongs to several Groups.

### Project
- Project is a collection of Tasks.
- It's available for registered and assigned User known as Member.
- Each Users can belongs to several Projects.

### Member
- Member is a registered User which belongs to a Project with one Group. 
- User can belongs to several Groups for one Project.
- Member can be assigned to serveral Tasks.
- Member can be assigned to serveral Projects.
- Member can be an author of several Tasks.
- Member can be an author of several Tickets. 
- Member can update its assigned Task's status.
- Member can get several TimeTrackers. 

### Task
- Task refer to one Project.
- Task refer to one Member known as author.
- Task can refer to several Tags.
- Task can be assigned to several Members.
- Task can refer to several Tickets.
- Task can refer to one other Task known as ParentTask.
- Task can refer to several Status.

### TimeTracker
- TimeTracker can refer to several Tags.
- TimeTracker can get an comment.
- TimeTracker refer to one Member.
- TimeTracker refer to one Task.
- TimeTracker has got a start date.
- TimeTracker can get a end date.

### Ticket
- Ticket can refer to several Tags.
- Ticket can refer to several Tasks.
- Ticket refer to one Member known as author.

### Status
- Status is a state of Task.
- Status refer to one Member.
- Status refer to one Task.
- Status has got a creation date.
