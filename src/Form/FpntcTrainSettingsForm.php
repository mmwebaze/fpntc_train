<?php
namespace Drupal\fpntc_train\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class FpntcTrainSettingsForm extends ConfigFormBase
{
    /*
   * {@inheritdoc}
   */
    public function getFormId() {
        return 'fpntc_train_settings_form';
    }

    /*
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return ['fpntc_train.settings'];
    }

    /*
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $form = parent::buildForm($form, $form_state);
        $config = $this->config('fpntc_train.settings');

        $form['train'] = array(
            '#type' => 'fieldset',
            '#title' => $this->t('FPNTC TRAIN Settings'),
        );

        $form['train']['link'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('TRAIN Link'),
            '#default_value' => $config->get('fpntc_train.link'),
            '#required' => TRUE,
        );

        $form['train']['username'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('TRAIN Username'),
            '#default_value' => $config->get('fpntc_train.username'),
            '#required' => TRUE,
        );

        $form['train']['password'] = array(
            '#type' => 'password',
            '#title' => $this->t('TRAIN Password'),
            '#default_value' => $config->get('fpntc_train.password'),
            '#required' => TRUE,
        );

        return $form;
    }
    /*
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state){
        drupal_set_message('*** '.$form_state->getValue('password'));
        $config = $this->config('fpntc_train.settings');
        $config->set('fpntc_train.link', $form_state->getValue('link'));
        $config->set('fpntc_train.username', $form_state->getValue('username'));
        $config->set('fpntc_train.password', $form_state->getValue('password'));
        $config->save();
        return parent::submitForm($form, $form_state);
    }
}