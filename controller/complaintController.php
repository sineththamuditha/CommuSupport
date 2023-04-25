<?php

namespace app\controller;

use app\core\Controller;
use app\core\middlewares\complaintMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\complaintModel;

class complaintController extends Controller
{
    public function __construct(string $func, Request $request, Response $response)
    {
        $this->middleware = new complaintMiddleware();
        parent::__construct($func, $request, $response);

    }

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
            }
            else {

                $this->setFlash('result', 'Complaint failed to submitted');
            }
        }

        $this->render("./donee/complaint/create",'File a Complaint',[
            'complaint'=>$model
        ]);

        }




}