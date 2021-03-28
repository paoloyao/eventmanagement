<?php 
use yii\helpers\Html;
$this->title = 'Admin - Manage Guests' ;
?>
<div>
    <span><?= Html::a('Create Guest', ['/site/create-guest'], ['class' => 'btn btn-info mb-2']) ?></span>
</div>
<div class='body-content'>
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
            <th scope="col">Events</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php if(count($guests) > 0): ?>
    <?php foreach($guests as $guest): ?>
        <tr class="table-active">
        <td><?php echo $guest->id; ?></td>
        <td><?php echo $guest->first_name; ?></td>
        <td><?php echo $guest->last_name; ?></td>
        <td><?php echo $guest->email; ?></td>
        <td><?php echo $guest->phone; ?></td>
        <td><?php echo $guest->gender; ?></td>
        <td><?php echo $guest->address; ?></td>
        <td><?php echo $guest->events; ?></td>
        <td>
            <span><?= Html::a('View') ?></span>
            <span><?= Html::a('Update') ?></span>
            <span><?= Html::a('Delete') ?></span>
        </td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
            <tr>No Records Found</tr>
        <?php endif; ?>
    </tbody>
    </table>
</div>