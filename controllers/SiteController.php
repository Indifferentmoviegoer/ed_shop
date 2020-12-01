<?php

namespace app\controllers;


use app\models\Product;
use Yii;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\data\Pagination;
use app\models\Category;
use app\models\SignupForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\User;



class SiteController extends AppController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
//                    [
//                        'actions' => ['/about'],
//                        'allow' => true,
//                        'roles' => [User::ROLE_ADMIN],
//                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = Product::find();
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize'=>6, 'forcePageParam'=>false,'pageSizeParam'=>false]);
        $hits = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $this->setMeta('ED-SHOP');

        return $this->render('index',compact('hits','pagination'));
    }
    public function actionView($id){
        $id=Yii::$app->request->get('id');
        //$cat=Category::find()->where(['=', 'parent_id', 1]);
//        $cat=Category::findAll()->where(['=', 'parent_id', $id]);
        $cat=Category::findAll(['parent_id'=>$id]);
            $ids = [];
        if(!count($cat)){
            $query=Product::find()->where(['category_id'=>$id]);
        }
        else{

            foreach($cat as $c){
                $ids[]=$c['id'];
            }
            $ids=implode(',',$ids);
            $query=Product::find()->where('category_id IN ('.$ids.')');
        }
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize'=>6, 'forcePageParam'=>false,'pageSizeParam'=>false]);
        $products = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $category=Category::findOne($id);
        $this->setMeta('ED-SHOP | ' .$category->name);
        return $this->render('view', compact('products','category','pagination'));
    }
    public function actionSearch(){
        $q=trim(Yii::$app->request->get('q'));
        if(!$q)
            return $this->render('search');
        $query=Product::find()->where(['like','name',$q]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize'=>6, 'forcePageParam'=>false,'pageSizeParam'=>false]);
        $products = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $this->setMeta('Результаты поиска: ' .$q);
        return $this->render('search',compact('products','pagination','q'));
    }




    public function actionSignup()
    {
        $model = new SignupForm(); // Не забываем добавить в начало файла: use app\models\SignupForm; или заменить 'new SignupForm()' на '\app\models\SignupForm()'

        if ($model->load(Yii::$app->request->post())) { // Если есть, загружаем post данные в модель через родительский метод load класса Model
            if ($user = $model->signup()) { // Регистрация
                if (Yii::$app->getUser()->login($user)) { // Логиним пользователя если регистрация успешна
                    return $this->goHome(); // Возвращаем на главную страницу
                }
            }
        }

        return $this->render('signup', [ // Просто рендерим вид если один из if вернул false
            'model' => $model,
        ]);
    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }


//    public function actionLogin()
//    {
//        if (!\Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }
//
//        $model = new LoginForm();
//        if ($model->load(Yii::$app->request->post()) && $model->loginAdmin()) {
//            return $this->goBack();
//        } else {
//            return $this->render('login', [
//                'model' => $model,
//            ]);
//        }
//    }



    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
           // 'Проверьте свою электронную почту для получения дальнейших инструкций.'
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }



//    public function actionAddAdmin() {
//        $model = User::find()->where(['username' => 'admin'])->one();
//        if (empty($model)) {
//            $user = new User();
//            $user->username = 'admin';
//            $user->email = 'voloshchenko_ivan_1999@mail.ru';
//            $user->setPassword('admin');
//            $user->generateAuthKey();
//            if ($user->save()) {
//                echo 'good';
//            }
//        }
//    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Проверьте свою электронную почту для получения дальнейших инструкций.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Извините, мы не можем сбросить пароль для отправки по электронной почте.');
            }
        }

        return $this->render('passwordResetRequestForm', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Новый пароль был сохранен.');
            return $this->goHome();
        }

        return $this->render('resetPasswordForm', [
            'model' => $model,]);
      }


}


