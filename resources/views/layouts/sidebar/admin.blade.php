 <li><a href="widget-basic.html" class="ai-icon" aria-expanded="false">
         <i class="flaticon-013-checkmark"></i>
         <span class="nav-text">Home</span>
     </a>
 </li>
 <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
         <i class="flaticon-072-printer"></i>
         <span class="nav-text">Settings</span>
     </a>
     <ul aria-expanded="false">
         <li><a href="{{ route('settings.basic.index') }}">School Settings</a></li>
         <li><a href="{{ route('settings.sessions.index') }}">Sessions</a></li>
         <li><a href="{{ route('settings.sections.index') }}">School Sections</a></li>
         <li><a href="{{ route('settings.classes.index') }}">Classes</a></li>
         <li><a href="{{ route('settings.subjects.index') }}">Subjects</a></li>
         <li><a href="{{ route('settings.assign_subjects.index') }}">Subjects Assignment</a></li>
         <li><a href="{{ route('settings.ca_scheme.index') }}">CA Scheme</a></li>
         
     </ul>
 </li>
 <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
         <i class="flaticon-072-printer"></i>
         <span class="nav-text">Users</span>
     </a>
     <ul aria-expanded="false">
         <li><a href="{{ route('users.students.index') }}">Students</a></li>   
         <li><a href="{{ route('users.students.bulk_update.index') }}">Bulk Update</a></li>   
     </ul>
 </li>
 <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
         <i class="flaticon-072-printer"></i>
         <span class="nav-text">Marks Entry</span>
     </a>
     <ul aria-expanded="false">
         <li><a href="{{ route('marks.create') }}">Enter Marks</a></li>   
         <li><a href="{{ route('marks.grade_book.index') }}">Grade book</a></li>   
         <li><a href="{{ route('marks.submissions.index') }}">Submissions</a></li>   
     </ul>
 </li>
