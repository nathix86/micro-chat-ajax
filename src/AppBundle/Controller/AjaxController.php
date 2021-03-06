<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/ajax")
 */
class AjaxController extends Controller
{
    /**
     * @Method({"POST"})
     * @Route("/send", name="ajax_send")
     */
    public function sendAction(Request $request)
    {
        if(!$request->isXmlHttpRequest() || !$request->request->has('content')){
            throw $this->createNotFoundException();
        }

        $manager = $this->get('micro_chat.chat_manager');

        return new JsonResponse($manager->send($request));
    }

    /**
     * @Method({"GET"})
     * @Route("/messages", name="ajax_messages")
     */
    public function messagesAction(Request $request)
    {
        if(!$request->isXmlHttpRequest()){
            throw $this->createNotFoundException();
        }

        $manager = $this->get('micro_chat.chat_manager');

        return new JsonResponse($manager->getMessages());
    }

    /**
     * @Method({"GET"})
     * @Route("/wash_conversation", name="ajax_wash_conversation")
     */
    public function washAction(Request $request)
    {
        if(!$request->isXmlHttpRequest()){
            throw $this->createNotFoundException();
        }

        $manager = $this->get('micro_chat.chat_manager');

        return new JsonResponse($manager->washConversation());
    }

    /**
     * @Method({"GET"})
     * @Route("/users", name="ajax_users")
     */
    public function usersAction(Request $request)
    {
        if(!$request->isXmlHttpRequest()){
            throw $this->createNotFoundException();
        }

        $manager = $this->get('micro_chat.chat_manager');

        return new JsonResponse($manager->getUsers());
    }

    /**
     * @Method({"GET"})
     * @Route("/update/user", name="ajax_update_user")
     */
    public function updateUserAction(Request $request)
    {
        if(!$request->isXmlHttpRequest()){
            throw $this->createNotFoundException();
        }

        $manager = $this->get('micro_chat.chat_manager');

        return new JsonResponse($manager->updateUserStatus($this->getUser()));
    }

    /**
     * @Method({"GET"})
     * @Route("/status/all", name="ajax_status_all")
     */
    public function statusAllAction(Request $request)
    {
        if(!$request->isXmlHttpRequest()){
            throw $this->createNotFoundException();
        }

        $manager = $this->get('micro_chat.chat_manager');

        return new JsonResponse($manager->getAllStatus());
    }
}
