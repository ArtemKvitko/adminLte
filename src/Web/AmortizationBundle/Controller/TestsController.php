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
        echo rand(11, 23424234) . '<hr/>';

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
        ksort($parentArr);

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


        return $this->render('WebAmortizationBundle:Tests:dql.html.twig', array(
                    'amortizations' => $amortizations,
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
