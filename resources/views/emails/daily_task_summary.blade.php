<h2 style="color: #af4c4c">Today Tasks</h2>
<table border="0" cellspacing="0" cellpadding="10"
    style="width: 100%; border-collapse: collapse; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <thead style="background-color: #af4c4c; color: #fff;">
        <tr>
            <th style="padding: 15px; text-align: left;">Task Name</th>
            <th style="padding: 15px; text-align: left;">Description</th>
            <th style="padding: 15px; text-align: left;">Due Date</th>
            <th style="padding: 15px; text-align: left;">Project Name</th>
            <th style="padding: 15px; text-align: left;">Label Name</th>
            <th style="padding: 15px; text-align: left;">Priority</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($todayTasks as $todayTask)
            <tr style="border-bottom: 1px solid #e5c8c8; transition: background-color 0.3s;">
                <td style="padding: 15px; text-align: center;">{{ $todayTask['task_name'] }}</td>
                <td style="padding: 15px; text-align: center;">{{ $todayTask['task_description']==''? "--": $todayTask['task_description'] }}</td>
                <td style="padding: 15px; text-align: center; white-space: nowrap;">{{ $todayTask['due_date'] }}</td>
                <td style="padding: 15px; text-align: center;">{{ $todayTask['label_name']==''? "--":$todayTask['label_name'] }}</td>
                <td style="padding: 15px; text-align: center;">{{ $todayTask['project_name']==''? "--":$todayTask['project_name'] }}</td>
                <td style="padding: 15px; text-align: center;">{{ $todayTask['priority'] }}</td>
            </tr>
        @empty
            <tr style="border-bottom: 1px solid #e5c8c8; transition: background-color 0.3s; white-space: nowrap;">
                <td style="padding: 15px; text-align: center;"  colspan="6">!! NO
                    TASKS FOR TODAY !!</td>
            </tr>
        @endforelse
    </tbody>
</table>
