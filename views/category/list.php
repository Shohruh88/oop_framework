<h1>Bu category list</h1>
<table class="table">

    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
    </tr>
    </thead>
    <tbody>
    <?php

    foreach($list as $item){
         echo "<tr>";
         echo "<td>".$item['id']."</td>";
         echo "<td>".$item['name']."</td>";
         echo "</tr>";
    //     echo $item->name;
    }
    ?>
    </tbody>
</table>
