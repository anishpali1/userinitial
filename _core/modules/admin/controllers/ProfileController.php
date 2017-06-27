<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\AdminChangePasswordForm;
use app\models\AdminProfileForm;

class ProfileController extends AdminAbstractController {

    public function actionIndex() {

        $id = Yii::$app->user->identity->id;
        $changePasswordModel = AdminChangePasswordForm::findOne($id);
        $myProfileModel = AdminProfileForm::findOne($id);


        return $this->render('index', ['profileModel' => $myProfileModel,
                    'changePasswordModel' => $changePasswordModel]);
    }

    public function actionUpdate() {
        $id = Yii::$app->user->identity->id;
        //Two models are loaded as profile & password change forms are in the same page
        $changePasswordModel = AdminChangePasswordForm::findOne($id);
        $myProfileModel = AdminProfileForm::findOne($id);
        if ($myProfileModel->load(Yii::$app->request->post())) {
            //profile image upload
            if (Yii::$app->request->isPost) {

                $myProfileModel->imageFile = UploadedFile::getInstance($myProfileModel, 'imageFile');
                if (!empty($myProfileModel->imageFile)) {

                    $fileName = rand() . '.' . $myProfileModel->imageFile->extension;
                    if ($myProfileModel->imageFile->saveAs(Yii::$app->params['profileDirectory'] . $fileName)) {
                        $myProfileModel->imageFile = "";
                        $myProfileModel->profile_picture = $fileName;
                    }
                }
            }

            if ($myProfileModel->save()) {
                Yii::$app->session->setFlash('success', 'Your profile has been updated.');
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('danger', "Sorry,We couldn't update your profile.");
            }
        }

        return $this->render('index', ['profileModel' => $myProfileModel,
                    'changePasswordModel' => $changePasswordModel]);
    }

    /*
     * Change Password
     */

    public function actionChangepassword() {
        $id = Yii::$app->user->identity->id;
        //Two models are loaded as profile & password change forms are in the same page
        $changePasswordModel = AdminChangePasswordForm::findOne($id);
        $myProfileModel = AdminProfileForm::findOne($id);

        if ($changePasswordModel->load(Yii::$app->request->post())) {


            $newpassword = $changePasswordModel->repeatnewpass;
            $hash = Yii::$app->getSecurity()->generatePasswordHash($newpassword);

            $changePasswordModel->password = $hash;
            if ($changePasswordModel->save()) {
                Yii::$app->session->setFlash('success', 'Password changed successfully!');
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('danger', "Sorry,We couldn't update your password.");
                $changePasswordModel->currentpass = '';
                $changePasswordModel->newpass = '';
                $changePasswordModel->repeatnewpass = '';
            }
        }

        return $this->render('index', ['profileModel' => $myProfileModel,
                    'changePasswordModel' => $changePasswordModel]);
    }

}
