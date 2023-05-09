<?php

namespace app\controller;

use app\core\Controller;
use app\core\middlewares\complaintMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\complaintModel;
use app\models\notificationModel;

class complaintController extends Controller
{
    public function __construct(string $func, Request $request, Response $response)
    {
        $this->middleware = new complaintMiddleware();
        parent::__construct($func, $request, $response);

    }

    //  retrieve complaints filed by users
    protected function viewComplaints(Request $request, Response $response)
    {
        $userType = $this->getUserType();
        $complaints = new complaintModel();
        $user = $this->getUserModel();

        $this->render($userType . '/complaints/view','Complaints',[
            "complaints"=> $complaints,
            "user"=>$user
        ]);
    }

   // getting complaints filed by the donor
    public function donorFileComplaint(Request $request, Response $response)
    {

        $this->checkLink($request);
        //creating model to make new complaint from donor
        $model =new complaintModel();


        if($request->isPost()){
            $model ->getData($request->getBody());

            if($model->validate($request->getBody()) && $model->save()){
                $this->setFlash("result",'Complaint submitted');
                $model->reset();
            }
            else {

                $this->setFlash('result', 'Complaint failed to submitted');
            }
        }
        if($request->isGet()){

            $model->subject=$_GET['processID'];

        }

        $this->render("./donor/complaints/file",'File a Complaint',[
            'complaint'=>$model,


        ]);

    }
   // getting complaints filed by donee
    protected function doneeFileComplaint(Request $request, Response $response)
    {
        $this->checklink($request);
       //creating model to make a new complaint from donee
        $model = new complaintModel();
        if($request->isPost())
        {
            $model->getData($request->getBody());

            if($model->validate($request->getBody()) && $model->save())
            {
                $this->setFlash('result','Complaint submitted');
                $model->reset();
            }
            else {

                $this->setFlash('result', 'Complaint failed to submitted');
            }
        }

        if($request->isGet())
        {
            $model->subject=$_GET['processID'];
        }

        $this->render("./donee/complaints/file",'File a Complaint',[
            'complaint'=>$model
        ]);

        }


        // cho review complaint and submit the solution for each problem
        protected function addSolution(Request $request,Response $response)
        {

            $this->checkLink($request);

            $model = new complaintModel();

            if($request->isPost())
            {
                $model->getData($request->getBody());

                if(!empty($model->solution)){
                    $model->submitSolution($model->solution,$model->complaintID);
                    notificationModel::setNotification("Complaint reviewed. Check Complaints page for solution ","Solution",$model->filedBy,"","",$model->complaintID);
                    $this->setFlash('result','Solution Added');
                }
                else{
                    $model->addError('solution','No solution has filed');
                    $this->setFlash('result','Solution failed to added');
                }

            }

            // check the request and get complaintID and filedBy from the complaint model
            if($request->isGet())
            {
                $model->complaintID=$_GET['complaintID'];
                $model->filedBy=$_GET['filedBy'];

            }

            echo $model->complaintID;
            $this->render("./cho/complaints/solution","Solution Submit",[
                // render
                'solution'=>$model,

            ]);
        }



}