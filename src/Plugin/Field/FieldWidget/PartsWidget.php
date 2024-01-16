<?php

namespace Drupal\digitalia_muni_parts_field\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;

/**
 * Defines the 'digitalia_muni_parts_field_parts' field widget.
 *
 * @FieldWidget(
 *   id = "digitalia_muni_parts_field_parts",
 *   label = @Translation("Parts"),
 *   field_types = {"digitalia_muni_parts_field_parts"},
 * )
 */
class PartsWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {

    $element['type'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Type'),
      '#default_value' => isset($items[$delta]->type) ? $items[$delta]->type : NULL,
    ];

    $element['author'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Author'),
      '#default_value' => isset($items[$delta]->author) ? $items[$delta]->author : NULL,
    ];

    $element['title'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Title'),
      '#default_value' => isset($items[$delta]->title) ? $items[$delta]->title : NULL,
    ];

    $element['#theme_wrappers'] = ['container', 'form_element'];
    $element['#attributes']['class'][] = 'digitalia-muni-parts-field-parts-elements';
    $element['#attached']['library'][] = 'digitalia_muni_parts_field/digitalia_muni_parts_field_parts';

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function errorElement(array $element, ConstraintViolationInterface $violation, array $form, FormStateInterface $form_state) {
    return isset($violation->arrayPropertyPath[0]) ? $element[$violation->arrayPropertyPath[0]] : $element;
  }

  /**
   * {@inheritdoc}
   */
  public function massageFormValues(array $values, array $form, FormStateInterface $form_state) {
    foreach ($values as $delta => $value) {
      if ($value['type'] === '') {
        $values[$delta]['type'] = NULL;
      }
      if ($value['author'] === '') {
        $values[$delta]['author'] = NULL;
      }
      if ($value['title'] === '') {
        $values[$delta]['title'] = NULL;
      }
    }
    return $values;
  }

}
