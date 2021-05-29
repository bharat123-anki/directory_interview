<table class="table distributorInfo">
   <thead>
      <tr>
         <th scope="col">#</th>
         <th scope="col">First Name</th>
         <th scope="col">Middle Name</th>
         <th scope="col">Last Name</th>
         <th scope="col">Email</th>
         <th scope="col">Mobile</th>
         <th scope="col">Landline</th>
         <th scope="col">Image</th>
         <th scope="col">Action</th>
      </tr>
   </thead>
   <tbody>
      <?php foreach ($directoryInfo as $key => $value) { ?>
         <tr>
            <th scope="row"><?php echo $key + 1; ?></th>
            <td><?php echo $value['first_name']; ?></td>
            <td><?php echo $value['middle_name']; ?></td>
            <td><?php echo $value['last_name']; ?></td>
            <td><?php echo $value['email']; ?></td>
            <td><?php echo $value['mobile_no']; ?></td>
            <td><?php echo $value['landline_no']; ?></td>
            <!--             <td><?php echo strtotime($value['c_day']);

                              echo date("d/m/y", strtotime($value['c_day']));
                              ?></td> -->
            <td>
               <?php $image_path = "No Image Found";
               if (isset($value['user_image_path'])) {
                  if (!empty($value['user_image_path'])) {
                     $image_path = '<a href="' . base_url('uploads/user_images/') . $value['user_image_path'] . '" target="_blank" >Image</a>';
                  }
               }
               echo $image_path;
               ?>

            </td>
            <td data-id="<?php echo $value['id'] ?>">
               <a href="javascript:void(0)" class="candidateEditdata"><i class="fa fa-edit"></i> </a>|<a href="javascript:void(0)" class="candidatedeletedata"><i class="fa fa-trash"></i></a>|<a href="javascript:void(0)" class="candidateviewDirectory"><i class="fa fa-eye"></i></a>|<a href="<?php echo base_url()  ?>index.php/DirectoryInfo/chartViewOfDirectory/<?php echo $value['id'];  ?>" target="_blank"><i class="fas fa-chart-bar"></i></a>

            </td>

         </tr>
      <?php } ?>

   </tbody>
</table>




<script type="text/javascript">
   $('.distributorInfo').DataTable({

   });
</script>