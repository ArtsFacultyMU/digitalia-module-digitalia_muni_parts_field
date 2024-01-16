<?php

namespace Drupal\digitalia_muni_parts_field\Plugin\Field\FieldType;

use Drupal\Component\Utility\Random;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Defines the 'digitalia_muni_parts_field_parts' field type.
 *
 * @FieldType(
 *   id = "digitalia_muni_parts_field_parts",
 *   label = @Translation("Parts"),
 *   category = @Translation("General"),
 *   default_widget = "digitalia_muni_parts_field_parts",
 *   default_formatter = "digitalia_muni_parts_field_parts_default"
 * )
 */
class PartsItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    if ($this->type !== NULL) {
      return FALSE;
    }
    elseif ($this->author !== NULL) {
      return FALSE;
    }
    elseif ($this->title !== NULL) {
      return FALSE;
    }
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {

    $properties['type'] = DataDefinition::create('string')
      ->setLabel(t('Type'));
    $properties['author'] = DataDefinition::create('string')
      ->setLabel(t('Author'));
    $properties['title'] = DataDefinition::create('string')
      ->setLabel(t('Title'));

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function getConstraints() {
    $constraints = parent::getConstraints();

    // @todo Add more constraints here.
    return $constraints;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {

    $columns = [
      'type' => [
        'type' => 'varchar',
        'length' => 255,
      ],
      'author' => [
        'type' => 'varchar',
        'length' => 255,
      ],
      'title' => [
        'type' => 'text',
        'size' => 'big',
      ],
    ];

    $schema = [
      'columns' => $columns,
      // @DCG Add indexes here if necessary.
    ];

    return $schema;
  }

  /**
   * {@inheritdoc}
   */
  public static function generateSampleValue(FieldDefinitionInterface $field_definition) {

    $random = new Random();

    $values['type'] = $random->word(mt_rand(1, 255));

    $values['author'] = $random->word(mt_rand(1, 255));

    $values['title'] = $random->paragraphs(5);

    return $values;
  }

}
