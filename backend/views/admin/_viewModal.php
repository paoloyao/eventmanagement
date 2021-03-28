<?php $this->title = 'modal'; ?>

<div class="modal-body">
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Gender</th>
                <th scope="col">Address</th>
            </tr>
        </thead>
        <tbody>
            <tr class="table-active">
                <td><?php echo $model->id; ?></td>
                <td><?php echo $model->first_name; ?></td>
                <td><?php echo $model->last_name; ?></td>
                <td><?php echo $model->email; ?></td>
                <td><?php echo $model->phone; ?></td>
                <td><?php echo $model->gender; ?></td>
                <td><?php echo $model->address; ?></td>
            </tr>
        </tbody>
    </table>
</div>