<?php

namespace CollDev\FagerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CollDev\FagerBundle\Entity\Statistic;
use Symfony\Component\HttpFoundation\Response;

/**
 * Statistic controller.
 *
 * @Route("/statistic")
 */
class StatisticController extends Controller
{
    /**
     * Lists all Statistic entities.
     *
     * @Route("/", name="statistic")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CollDevFagerBundle:Statistic')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Statistic entity.
     *
     * @Route("/", name="statistic_create")
     * @Method("POST")
     * @Template("CollDevFagerBundle:Statistic:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Statistic();
        $data = array(
            'total'      => $request->request->get('total'),
            'keystrokes' => $request->request->get('keystrokes'),
            'correct'    => $request->request->get('correct'),
            'wrong'      => $request->request->get('wrong'),
            'start_time' => $request->request->get('start_time'),
            'end_time'   => $request->request->get('end_time'),
            'duration'   => $request->request->get('duration'),
            'user_input' => $request->request->get('user_input'),
            'mistakes'   => $request->request->get('mistakes'),
            'goodies'    => $request->request->get('goodies'),
            'backspace_counter' => $request->request->get('backspace_counter'),
        );

        if (!empty($data)) {
            $em = $this->getDoctrine()->getManager();
            
            $stats = $this->calcStats($data);
            
            $entity->setIp($request->getClientIp());
            $entity->setTotal($stats['total']);
            $entity->setKeystrokes($stats['keystrokes']);
            $entity->setCorrect($stats['correct']);
            $entity->setWrong($stats['wrong']);
            $entity->setElapsedTime($stats['elapsed_time']);
            $entity->setUserInput($stats['user_input']);
            $entity->setMistakes($stats['mistakes']);
            $entity->setGoodies($stats['goodies']);
            $entity->setBackspaceCounter($stats['backspace_counter']);
            
            $em->persist($entity);
            $em->flush();

            $return = array("responseCode" => 200, 'response' => 'Statistic successfully created.', 'stats' => $stats);
        }else{
            $return = array("responseCode" => 400, 'response' => 'Statistic creation failed.');
        }
        return new Response(json_encode($return), 200, array('Content-Type'=>'application/json'));
    }

    /**
     * Finds and displays a Statistic entity.
     *
     * @Route("/{id}", name="statistic_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CollDevFagerBundle:Statistic')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Statistic entity.');
        }

        return array('entity' => $entity);
    }

    /**
     * Calcualtes statistics from data received
     * 
     * @param type $stats
     */
    private function calcStats($data)
    {
        $elapsed_time = $data['end_time'] - $data['start_time'];
        $stats = array(
            'total'        => $data['total'],
            'keystrokes'   => $data['keystrokes'],
            'correct'      => $data['correct'],
            'wrong'        => $data['wrong'],
            'elapsed_time' => $elapsed_time,
            'user_input'   => $data['user_input'],
            'mistakes'     => $data['mistakes'],
            'goodies'      => $data['goodies'],
            'backspace_counter' => $data['backspace_counter'],
            
            'accuracy' => round($data['correct'] * 100 / $data['total'], 2),
            'error' => round($data['mistakes'] * 100 / $data['goodies'], 2),
            'wpm' => round(($data['correct'] * 60 * 1000) / $elapsed_time, 2),
            'kps' => round(($data['goodies'] * 1000) / $elapsed_time, 2),
            
        );
        
        return $stats;
    }
}