<?php

namespace App;


class node 
{
 
public $left;
public $right;
public $value; 

/*
        create a binary tree with some input given.

see what level I'm in.
level x, see if I have so many elements in the input
pop 2^(x-1) elements from queue. keep adding left and rights to those.

        1
    2       3
  4  5    6   7
 8 9

*/


public static function createbinarytree(){



$input = array(1,2,3,4,5,6,7,8,9);

$queue = array();

$i = 0;

$level = 2;
$max = count($input);

$current = new node();
$current->value = $input[$i++];
$current->left = null;
$current->right = null;

array_unshift($queue,  $current);

echo $current->value." ";

while ( $i < $max )
{
        $j = pow(2,$level-1);

        // create nodes until 2^(level-1) and
        while( $j > 0  && $i < $max )
        {

                $parent = array_pop($queue);

                // create a left node
                $newLeft = new node();
                $newLeft->value = $input[$i++];
                $newLeft->left = null;
                $newLeft->right = null;

                $parent->left =  $newLeft;
                array_unshift($queue, $newLeft);

                $j--;

                if($i >= $max || $j <= 0)
                {
                   break;
                }

                // create right node
                $newRight = new node();
                $newRight->value = $input[$i++];
                $newRight->left = null;
                $newRight->right = null;

                $parent->right = $newRight;
                array_unshift($queue, $newRight);

                $j--;
                echo print_r($parent);

        }

        $level++;
        echo "level :".$level;
        //echo print_r($queue,1);
}
  return $parent;
}


// Traverse the tree in BFT
// take the top, push all children. print current node.
// go to next level if all done with current level
// same logic almost.

public static function BFT(){
//$input = array(1,2,3,4,5,6,7,8,9);

$queue = array(node::createbinarytree());
//$BFTQueue = array();
//$BFTQueue = array(1,2,3,4,5,6,7,8,9);
$BFTQueue =$queue;
$current = array_pop($BFTQueue);
//$current = array_shift($BFTQueue);
   
array_unshift($BFTQueue,  $current);

//echo "visit: ".$current;
$data="";

echo "visit: ".$current->value;
$data="<ul>
<li>".$current->value."</li>
";
while( count($BFTQueue) > 0 )
{
// next level.
$BFTCurrent = array_pop($BFTQueue);

// print the value and push
echo "visit: ".$BFTCurrent->value;
$data="
<li>".$current->value."</li>
</ul>
";

if($BFTCurrent->left)
{
        array_unshift($BFTQueue, $BFTCurrent->left);
}
if($BFTCurrent->right)
{
        array_unshift($BFTQueue, $BFTCurrent->right);
}

}
 echo $data;
}




}