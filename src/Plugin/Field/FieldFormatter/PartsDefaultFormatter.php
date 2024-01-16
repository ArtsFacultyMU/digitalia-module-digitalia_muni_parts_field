<?php

namespace Drupal\digitalia_muni_parts_field\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'digitalia_muni_parts_field_parts_default' formatter.
 *
 * @FieldFormatter(
 *   id = "digitalia_muni_parts_field_parts_default",
 *   label = @Translation("Default"),
 *   field_types = {"digitalia_muni_parts_field_parts"}
 * )
 */
class PartsDefaultFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];

    foreach ($items as $delta => $item) {

      if ($item->type) {
        $element[$delta]['type'] = [
          '#type' => 'item',
          '#title' => $this->t('Type'),
          '#markup' => $item->type,
        ];
      }

      if ($item->author) {
        $element[$delta]['author'] = [
          '#type' => 'item',
          '#title' => $this->t('Author'),
          '#markup' => $item->author,
        ];
      }

      if ($item->title) {
        $element[$delta]['title'] = [
          '#type' => 'item',
          '#title' => $this->t('Title'),
          '#markup' => $item->title,
        ];
      }

    }

    return $element;
  }

}
