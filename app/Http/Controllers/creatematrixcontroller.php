<?php

INSERT INTO `matrix_users` (`matrix_users_id`, `matrix_id`, `user_id`, `parentid`, `position`, `place`, `trpos`, `trchildrenp`, `tparent`, `children`, `stage`, `level`, `matrix_number`, `created_at`, `updated_at`) VALUES
(135, 19, 'HW00016023', '0', '0', '0', '1', '0', '0', '2', '0', '1', '0', NULL, NULL),
(136, 19, 'HW00016983', 'HW00016023', 'L', '0', '2', 'L', '1', '2', '0', '1', '0', NULL, NULL),
(137, 19, 'HW00016760', 'HW00016023', 'R', '0', '3', 'R', '1', '2', '0', '1', '0', NULL, NULL),
(138, 19, 'HW00016045', '0', 'L', '0', '4', 'L', '2', '2', '0', '1', '0', NULL, NULL),
(139, 19, 'HW00016053', '0', 'L', '0', '5', 'R', '2', '2', '0', '1', '0', NULL, NULL),
(140, 19, 'HW00016117', '0', 'L', '0', '6', 'L', '4', '0', '0', '1', '0', NULL, NULL),
(141, 19, 'HW00016068', '0', 'L', '0', '7', 'R', '4', '0', '0', '1', '0', NULL, NULL),
(142, 19, 'HW00016052', '0', 'L', '0', '8', 'L', '5', '0', '0', '1', '0', NULL, NULL),
(143, 19, 'HW00016060', '0', 'L', '0', '9', 'R', '5', '0', '0', '1', '0', NULL, NULL),
(144, 19, 'HW00016762', '0', 'R', '0', '10', 'L', '3', '2', '0', '1', '0', NULL, NULL),
(145, 19, 'HW00017036', '0', 'R', '0', '11', 'R', '3', '2', '0', '1', '0', NULL, NULL),
(146, 19, 'HW00017290', '0', 'R', '0', '12', 'L', '10', '0', '0', '1', '0', NULL, NULL),
(147, 19, 'HW00017311', '0', 'R', '0', '13', 'R', '10', '0', '0', '1', '0', NULL, NULL),
(148, 19, 'HW00017300', '0', 'R', '0', '14', 'L', '11', '0', '0', '1', '0', NULL, NULL),
(149, 19, 'HW00017577', '0', 'R', '0', '15', 'R', '11', '0', '0', '1', '0', NULL, NULL);




        $data = array(
    array(
      
       'matrix_id' => $getusermatrix, 'user_id' => $userid, 'parentid' => 0, 'position' => '0', 'place' => 0,'trpos' => 1, 'trchildrenp' => 0, 'tparent' => 0, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
       ),
    array(
     
         'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => $userid, 'position' => 'L', 'place' => 0, 'trpos' => 2, 'trchildrenp' => 'L', 'tparent' => 1, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
       ),
    array(
      
         'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => $userid, 'position' => 'R', 'place' => 0, 'trpos' => 3, 'trchildrenp' => 'R', 'tparent' => 1, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
       ),
    array(
      
         'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'L', 'place' => 0, 'trpos' => 4, 'trchildrenp' => 'L', 'tparent' => 2, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
       ),

    array(
      
         'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'L', 'place' => 0, 'trpos' => 5, 'trchildrenp' => 'R', 'tparent' => 2, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
       ),

    array(
      
         'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'L', 'place' => 0, 'trpos' => 6, 'trchildrenp' => 'L', 'tparent' => 4, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
       ),
    array(
      
         'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'L', 'place' => 0, 'trpos' => 7, 'trchildrenp' =>'R', 'tparent' => 4, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
       ),
    array(
      
         'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'L', 'place' => 0, 'trpos' => 8, 'trchildrenp' => 'L', 'tparent' => 5, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
       ),
    array(
      
         'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'L', 'place' => 0, 'trpos' => 9, 'trchildrenp' => 'R', 'tparent' => 5, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
       ),
    array(
      
         'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'R', 'place' => 0, 'trpos' => 10, 'trchildrenp' => 'L', 'tparent' => 3, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
       ),
    array(
      
         'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'R', 'place' => 0, 'trpos' => 11, 'trchildrenp' => 'R', 'tparent' => 3, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
       ),
    array(
      
         'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'R', 'place' => 0, 'trpos' => 12, 'trchildrenp' => 'L', 'tparent' =>10, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
       ),
    array(
      
         'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'R', 'place' => 0, 'trpos' =>13, 'trchildrenp' => 'R', 'tparent' => 10, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
       ),
    array(
      
         'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'R', 'place' => 0, 'trpos' => 14, 'trchildrenp' => 'L', 'tparent' => 11, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
       ),
    array(
      
         'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'R', 'place' => 0, 'trpos' => 15, 'trchildrenp' => 'R', 'tparent' => 11, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
       )
);

    DB::table('matrix_users')->insert($data);



      $data = array(
    array(
      
       'matrix_id' => $getusermatrix, 'user_id' => $userid, 'parentid' => 0, 'position' => '0', 'place' => 0,'trpos' => 1, 'trchildrenp' => 0, 'tparent' => 0, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
       ),
    array(
      
         'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => $userid, 'position' => 'L', 'place' => 0, 'trpos' => 2, 'trchildrenp' => 'L', 'tparent' => 1, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
       ),
    array(
      
         'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => $userid, 'position' => 'R', 'place' => 0, 'trpos' => 3, 'trchildrenp' => 'R', 'tparent' => 1, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
       ),
    array(
     
         'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'L', 'place' => 0, 'trpos' => 4, 'trchildrenp' => 'L', 'tparent' => 2, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
       ),

    array(
     
         'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'L', 'place' => 0, 'trpos' => 5, 'trchildrenp' => 'R', 'tparent' => 2, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
       ),

    array(
     
         'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'R', 'place' => 0, 'trpos' => 6, 'trchildrenp' => 'L', 'tparent' => 3, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
       ),
    array(
      
         'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'R', 'place' => 0, 'trpos' => 7, 'trchildrenp' =>'R', 'tparent' => 3, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
       )
    );

      DB::table('matrix_users')->insert($data);


            