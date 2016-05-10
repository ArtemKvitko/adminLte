<?php

namespace Web\AmortizationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Web\AmortizationBundle\Entity\Amortization;
use Web\AmortizationBundle\Form\AmortizationType;
use \Web\AmortizationBundle\Entity\Categories;
use Web\AssetsBundle\Entity\Assets;
use \Symfony\Component\Validator\Constraints\DateTime;

/**
 * Amortization controller.
 *
 */
class TestsController extends Controller {

    /**
     * Lists all Amortization entities.
     *
     */
    //

    public function arrayAction() {


        $A[0] = 2;
        $A[1] = 2;
        $A[2] = 2;
        $A[3] = 2;
        $A[4] = 2;
        $A[5] = 3;
        $A[6] = 4;
        $A[7] = 4;
        $A[8] = 4;
        $A[9] = 6;


        
        echo solution(&$A);
        
        function solution(&$A) {
            $n = sizeof($A);
            $L = array_pad(array(), $n + 1, -1);
            for ($i = 0; $i < $n; $i++) {
                $L[$i + 1] = $A[$i];
            }
            $count = 0;
            $pos = (int) (($n + 1) / 2);
            $candidate = $L[$pos];
            for ($i = 1; $i <= $n; $i++) {
                if ($L[$i] == $candidate)
                    $count = $count + 1;
            }
            if ($count > $pos)
                return $candidate;
            return (-1);
        }

        echo  '<hr/>'.rand(11, 23424234) . '<hr/>';

        exit();


        $Test = array(
            array(
                'id' => 1,
                'parentId' => 2
            ),
            array(
                'id' => 2,
                'parentId' => ""
            ),
            array(
                'id' => 3,
                'parentId' => 2
            ),
            array(
                'id' => 4,
                'parentId' => 3
            ),
            array(
                'id' => 5,
                'parentId' => 1
            ),
            array(
                'id' => 6,
                'parentId' => 5
            ),
            array(
                'id' => 7,
                'parentId' => 6
            ),
        );

        //$keyArr = array();
        $parentArr = array();
        foreach ($Test as $val) {
            //$keyArr[$val['id']] = $val['parentId']; 
            $parentArr[$val['parentId']][$val['id']] = "";
        }
        //ksort($keyArr);
        //ksort($parentArr);

        $treeArr = array();
        foreach ($parentArr[""] as $key => $val) {
            $treeArr[$key] = $this->ArrAddKeyTre($key, $parentArr);
        }


        //echo '<pre>'; var_dump($keyArr);
        //echo '<pre>'; var_dump($parentArr);
        echo '<pre>';
        var_dump($treeArr);

        exit();
    }

    public function dqlAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        //$amortizations = $em->getRepository('WebAmortizationBundle:Amortization')->getAmortizationsByAsertIdAlgTwo(5);
        $amortizations = $em->getRepository('WebAmortizationBundle:Amortization')->getAllOderByPeriodDesc();

        $count = 30;

        return $this->render('WebAmortizationBundle:Tests:dql.html.twig', array(
                    'amortizations' => $amortizations,
                    'count' => $count
        ));
    }

    public function lngAction(Request $request) {

        echo rand(11, 23424234) . '<hr/> dql<br/>';
        //$request->getSession()->set('_locale', "fr");
        $translator = $this->get('translator');
        echo $translator->trans('Symfony is great');
        exit();
    }

    //put your code here


    private function ArrAddKeyTre($key, $parentArr) {

        $tmp_arr = array();
        if (!array_key_exists($key, $parentArr)) {
            return "";
        }
        foreach ($parentArr[$key] as $key2 => $val) {
            $tmp_arr[$key2] = $this->ArrAddKeyTre($key2, $parentArr);
        }
        return $tmp_arr;
    }

}
